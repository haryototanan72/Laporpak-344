<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Complaint;
use Carbon\Carbon;

class LandingController extends Controller
{
    public function index()
    {
        // Statistik Total Laporan
        $totalLaporan = Report::count();
        
        // Statistik Laporan Bulan Ini
        $laporanBulanIni = Report::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Statistik Status Laporan
        $statusLaporan = [
            'diajukan' => Report::where('status', 'diajukan')->count(),
            'diverifikasi' => Report::where('status', 'diverifikasi')->count(),
            'diterima' => Report::where('status', 'diterima')->count(),
            'ditolak' => Report::where('status', 'ditolak')->count(),
            'ditindaklanjuti' => Report::where('status', 'ditindaklanjuti')->count(),
            'ditanggapi' => Report::where('status', 'ditanggapi')->count(),
            'selesai' => Report::where('status', 'selesai')->count(),
        ];

        // Hitung laporan dalam proses (semua status kecuali selesai dan ditolak)
        $statusLaporan['dalam_proses'] = Report::whereNotIn('status', ['selesai', 'ditolak'])->count();

        // Statistik Status dari tabel complaints
        $selesaiComplaint = Complaint::where('status', 'Selesai')->count();
        $prosesComplaint = Complaint::where('status', 'Proses')->count();

        // Laporan Terbaru (5 terakhir)
        $laporanTerbaru = Report::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('landing', compact(
            'totalLaporan',
            'laporanBulanIni',
            'statusLaporan',
            'selesaiComplaint',
            'prosesComplaint',
            'laporanTerbaru'
        ));
    }
}
