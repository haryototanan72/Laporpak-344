<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function showForm(Request $request)
    {
        $success = $request->query('success');
        $errors = $request->query('errors');

        return view('form_laporan', compact('success', 'errors'));
    }

    public function submitLaporan(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'jenis_laporan' => 'required',
            'bukti_laporan' => 'required|file|max:2048',
            'lokasi_laporan' => 'required',
            'ciri_khusus_lokasi' => 'nullable', // Ubah 'optional' menjadi 'nullable'
            'kategori_laporan' => 'required',
            'deskripsi_laporan' => 'required',
            'ceklis' => 'required', // Validasi checkbox persetujuan
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Lengkapi kolom yang kosong',
                'errors' => $validator->errors()
            ], 400);
        }

        // Simpan file bukti laporan
        $file = $request->file('bukti_laporan');
        $path = $file->store('bukti_laporan', 'public');

        // Generate nomor laporan unik
        $nomor_laporan = 'LAP' . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

        try {
            // Buat laporan baru
            $laporan = new Laporan();
            $laporan->nomor_laporan = $nomor_laporan;
            $laporan->jenis_laporan = $request->jenis_laporan;
            $laporan->lokasi_laporan = $request->lokasi_laporan;
            $laporan->ciri_khusus = $request->ciri_khusus_lokasi; // Perbaiki nama field
            $laporan->kategori_laporan = $request->kategori_laporan;
            $laporan->deskripsi_laporan = $request->deskripsi_laporan;
            $laporan->bukti_laporan = $path;
            $laporan->save();

            // Jika request expects JSON (AJAX)
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Laporan berhasil dikirim!',
                    'nomor_laporan' => $nomor_laporan
                ], 200);
            }
            // Jika submit biasa (non-AJAX)
            return redirect()->route('form_laporan')->with('nomor_laporan', $nomor_laporan);

        } catch (\Exception $e) {
            // Jika terjadi kesalahan, hapus file yang sudah diupload
            Storage::delete('public/' . $path);

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Gagal menyimpan laporan ke database',
                    'error' => $e->getMessage()
                ], 500);
            }
            return redirect()->route('form_laporan')->with('error', 'Gagal menyimpan laporan ke database: ' . $e->getMessage());
        }
    }
}