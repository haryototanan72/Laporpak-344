<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Petugas;
use App\Models\Laporan;
use Illuminate\Support\Facades\Log;

class PetugasLaporanController extends Controller
{
    // Tampilkan form pemberian tugas ke petugas
    public function create(Petugas $petugas)
    {
        return view('admin.kirim_laporan_petugas', compact('petugas'));
    }

    // Simpan tugas pemberian laporan ke petugas
    public function store(Request $request, Petugas $petugas)
    {
        $request->validate([
            'nomor_laporan' => 'required|exists:laporans,nomor_laporan',
        ]);

        // Cari laporan berdasarkan nomor laporan
        $laporan = \App\Models\Laporan::where('nomor_laporan', $request->nomor_laporan)->first();
        if (!$laporan) {
            return redirect()->back()->withErrors(['nomor_laporan' => 'Nomor laporan tidak ditemukan.']);
        }
        // Cek apakah sudah ada assignment serupa
        $exists = \App\Models\LaporanPetugas::where('petugas_id', $petugas->id)
            ->where('laporan_id', $laporan->id)
            ->exists();
        if ($exists) {
            return redirect()->back()->with('warning', 'Tugas ini sudah pernah dikirim ke petugas.');
        }
        // Simpan assignment ke tabel laporan_petugas
        \App\Models\LaporanPetugas::create([
            'petugas_id' => $petugas->id,
            'laporan_id' => $laporan->id,
            'status_verifikasi' => null,
        ]);
        return redirect()->route('admin.petugas.index')->with('success', 'Tugas berhasil dikirim ke petugas!');
    }
}
