<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $laporan = \App\Models\Laporan::query();

        // Filter
        if ($request->filled('status')) {
            $laporan->where('status', $request->status);
        }

        // Ganti filter tanggal_lapor ke created_at
        if ($request->filled('tanggal')) {
            $laporan->whereDate('created_at', $request->tanggal);
        }

        if ($request->filled('jenis')) {
            $laporan->where('jenis_laporan', $request->jenis);
        }

        // Pastikan data dummy selalu tampil untuk admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            // Jangan filter hanya milik user tertentu, biarkan tampil semua
        }

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

    public function updateStatus(Request $request, Laporan $laporan)
    {
        $validStatuses = [
            'diajukan', 'diverifikasi', 'diterima', 'ditolak', 'ditindaklanjuti', 'ditanggapi', 'selesai'
        ];

        $request->validate([
            'status' => 'required|in:' . implode(',', $validStatuses)
        ]);

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

    public function detail($id)
    {
        $laporan = Laporan::with('user')->findOrFail($id);

        return view('admin.laporan.detaillaporan', compact('laporan'));
    }

    public function show(Laporan $laporan)
    {
        return view('admin.laporan.show', compact('laporan'));
    }
}
