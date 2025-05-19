<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Petugas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::all();
        return view('admin.petugas', compact('petugas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kontak' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        try {
            // Pastikan nama petugas unik
            if (Petugas::where('nama', $request->nama)->exists()) {
                return redirect()->back()->withInput()->withErrors(['nama' => 'Nama petugas sudah terdaftar.']);
            }
            $data = $request->only(['nama', 'kontak']);
            if ($request->hasFile('foto')) {
                $data['foto'] = $request->file('foto')->store('petugas', 'public');
            }
            Petugas::create($data);
            return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Gagal simpan petugas: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi error: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Petugas $petugas)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kontak' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
        ]);

        try {
            // Pastikan nama petugas unik selain dirinya sendiri
            if (Petugas::where('nama', $request->nama)->where('id', '!=', $petugas->id)->exists()) {
                return redirect()->back()->withInput()->withErrors(['nama' => 'Nama petugas sudah terdaftar.']);
            }
            $petugas->nama = $request->nama;
            $petugas->kontak = $request->kontak;
            if ($request->hasFile('foto')) {
                if ($petugas->foto) {
                    Storage::disk('public')->delete($petugas->foto);
                }
                $petugas->foto = $request->file('foto')->store('petugas', 'public');
            }
            $petugas->save();
            return redirect()->route('admin.petugas.index')->with('success', 'Data petugas berhasil diupdate.');
        } catch (\Exception $e) {
            Log::error('Gagal update petugas: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi error: ' . $e->getMessage());
        }
    }

    public function destroy(Petugas $petugas)
    {
        try {
            // Debug: log info sebelum hapus
            Log::info('Akan hapus petugas: id=' . $petugas->id . ', nama=' . $petugas->nama);
            // Hapus foto jika ada
            if ($petugas->foto) {
                Storage::disk('public')->delete($petugas->foto);
            }
            // Pastikan petugas benar-benar dihapus
            $deleted = $petugas->delete();
            if ($deleted) {
                return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil dihapus.');
            } else {
                return redirect()->route('admin.petugas.index')->with('error', 'Gagal menghapus petugas. Data tidak terhapus dari database.');
            }
        } catch (\Exception $e) {
            Log::error('Gagal hapus petugas: ' . $e->getMessage() . ' | Trace: ' . $e->getTraceAsString());
            return redirect()->route('admin.petugas.index')->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
