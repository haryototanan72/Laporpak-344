<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
// use checkdate 

class LaporanController extends Controller
{
    public function index(Request $request)
    {

        $laporan = \App\Models\Laporan::query();

        // Filter
        if ($request->filled('status')) {
            $laporan->where('status', $request->status);
        }

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal')) {
            if ($request->tanggal === 'terbaru') {
                $laporan->orderBy('created_at', 'desc');
            } elseif ($request->tanggal === 'terlama') {
                $laporan->orderBy('created_at', 'asc');
            }
        } else {
            // Default: urutkan terbaru
            $laporan->orderBy('created_at', 'desc');
        }

        // // Pastikan data dummy selalu tampil untuk admin
        // if (auth()->check() && auth()->user()->role === 'admin') {
        //     // Jangan filter hanya milik user tertentu, biarkan tampil semua
        // }

        // Sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'terbaru':
                    $laporan->orderBy('created_at', 'desc');
                    break;
                case 'prioritas':
                    $laporan->orderBy('prioritas', 'desc');
                    break;
                case 'status':
                    $laporan->orderBy('status');
                    break;
            }
        } else {
            $laporan->orderBy('created_at', 'desc'); // Default sort
        }

        $laporans = $laporan->paginate(10);

        return view('admin.laporan.index', compact('laporans'));
    }


    public function updateStatus(Request $request, $nomor_laporan)
    {
        $validStatuses = [
            'diajukan', 'diverifikasi', 'diterima', 'ditolak', 'ditindaklanjuti', 'ditanggapi', 'selesai'
        ];

        $request->validate([
            'status' => 'required|in:' . implode(',', $validStatuses)
        ]);

        $laporan = Laporan::where('nomor_laporan', $nomor_laporan)->firstOrFail();
        $laporan->status = $request->status;
        $laporan->save();

        // Sinkronkan status ke complaint jika ada relasi nomor laporan
        $complaint = \App\Models\Complaint::where('name', $laporan->nomor_laporan)->first();
        if ($complaint) {
            $complaint->status = $request->status;
            $complaint->save();
        }

        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui');
    }

    public function detail($nomor_laporan)
    {
        $laporan = Laporan::with('user')->where('nomor_laporan', $nomor_laporan)->firstOrFail();
        return view('admin.laporan.detaillaporan', compact('laporan'));
    }

    public function show(Laporan $laporan)
    {
        return view('admin.laporan.show', compact('laporan'));
    }
}
