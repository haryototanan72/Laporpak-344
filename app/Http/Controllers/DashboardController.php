<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Laporan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    }

    public function admin()
    {
        // Statistik Status Laporan
        $statusLaporan = [
            'diajukan' => Laporan::where('status', 'diajukan')->count(),
            'diverifikasi' => Laporan::where('status', 'diverifikasi')->count(),
            'diterima' => Laporan::where('status', 'diterima')->count(),
            'ditolak' => Laporan::where('status', 'ditolak')->count(),
            'ditindaklanjuti' => Laporan::where('status', 'ditindaklanjuti')->count(),
            'ditanggapi' => Laporan::where('status', 'ditanggapi')->count(),
            'selesai' => Laporan::where('status', 'selesai')->count(),
        ];

        // Laporan Terbaru (5 terakhir)
        $laporanTerbaru = Laporan::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.admin', compact(
            'statusLaporan',
            'laporanTerbaru'
        ));
    }

    public function user()
    {
        // Ambil statistik laporan
        $total = Laporan::count();
        $baru = Laporan::where('status', 'baru')->count();
        $proses = Laporan::where('status', 'proses_verifikasi')->count();
        $verifikasi = Laporan::where('status', 'verifikasi')->count();
        $selesai = Laporan::where('status', 'selesai')->count();
        // Ambil 6 laporan terbaru
        $recentPosts = Laporan::latest()->take(6)->get();
        return view('dashboard.user', compact('total', 'baru', 'proses', 'verifikasi', 'selesai', 'recentPosts'));
    }
}
