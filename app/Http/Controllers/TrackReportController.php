<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Report;

class TrackReportController extends Controller
{
    public function showTrackPage()
    {
        return view('track-report.index');
    }

    public function search(Request $request)
    {
        $nomor_laporan = $request->input('nomor_laporan');
        
        // Hapus tanda kutip jika ada
        $nomor_laporan = str_replace('"', '', $nomor_laporan);
        
        $report = Report::where('nomor_laporan', $nomor_laporan)->first();
        
        if ($report) {
            $alasan_penolakan = null;
            $pesan_diterima = null;
            
            if ($report->status === 'Ditolak') {
                $alasan_penolakan = 'Maaf Laporan Anda Kurang Valid';
            } elseif ($report->status === 'Diterima') {
                $pesan_diterima = 'Laporan Anda Disetujui, Silakan Tunggu Prosesnya';
            }

            return view('track-report.result', [
                'report' => $report,
                'alasan_penolakan' => $alasan_penolakan,
                'pesan_diterima' => $pesan_diterima,
            ]);
        }
        return redirect()->back()->with('error', 'Nomor laporan tidak ditemukan');
    }
}
