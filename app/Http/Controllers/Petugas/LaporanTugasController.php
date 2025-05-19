<?php
namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class LaporanTugasController extends Controller
{
    // Daftar tugas laporan untuk petugas yang login
    public function index(Request $request)
    {
        $petugasId = $request->input('petugas_id');
        $petugasList = \App\Models\Petugas::all();
        $tugas = collect();
        $petugasSelected = null;
        if ($petugasId) {
            $tugas = \App\Models\LaporanPetugas::with('laporan')
                ->where('petugas_id', $petugasId)
                ->get();
            $petugasSelected = \App\Models\Petugas::find($petugasId);
        }
        return view('petugas.laporan_tugas', compact('tugas', 'petugasList', 'petugasSelected', 'petugasId'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
    'status' => 'required|in:diterima,ditolak',
    'kondisi_lapangan' => 'required|in:Darurat,Perlu Diperbaiki,Ringan',
    ]);

    $assignment = \App\Models\LaporanPetugas::findOrFail($id);
    $assignment->status_verifikasi = $request->status;
    $assignment->kondisi_lapangan = $request->kondisi_lapangan;
    $assignment->save();

    // Optional: Sinkronkan dengan laporan utama
    $laporan = $assignment->laporan;
    if ($laporan) {
        $laporan->status = $request->status;
        $laporan->save();
    }

    return redirect()->back()->with('success', 'Status dan kondisi berhasil diperbarui!');
}
}