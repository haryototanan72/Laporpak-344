<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatistikController extends Controller
{
    public function index()
    {
        // Total laporan
        $totalLaporan = Laporan::count();
        
        // Laporan bulan ini
        $laporanBulanIni = Laporan::whereMonth('created_at', Carbon::now()->month)
                                 ->whereYear('created_at', Carbon::now()->year)
                                 ->count();

        // Statistik status laporan
        $statusLaporan = Laporan::select('status', DB::raw('count(*) as total'))
                               ->groupBy('status')
                               ->get();

        // Statistik kategori laporan
        $kategoriLaporan = Laporan::select('kategori', DB::raw('count(*) as total'))
                                 ->groupBy('kategori')
                                 ->get();

        return view('statistik.index', [
            'totalLaporan' => $totalLaporan,
            'laporanBulanIni' => $laporanBulanIni,
            'statusLaporan' => $statusLaporan,
            'kategoriLaporan' => $kategoriLaporan
        ]);
    }
}
