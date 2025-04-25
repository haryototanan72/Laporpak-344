<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        {
            $laporans = Laporan::all();
            return view('admin.laporan.index', compact('laporans'));
        }
        // Mulai dari query dasar
        $laporan = Laporan::query();

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $laporan->where('status', $request->status);
        }

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal')) {
            $laporan->whereDate('tanggal_lapor', $request->tanggal);
        }

        // Filter berdasarkan jenis laporan (jika sudah ada field-nya)
        if ($request->filled('jenis')) {
            $laporan->where('jenis_laporan', $request->jenis); // sesuaikan dengan kolommu
        }

        // Sorting
        if ($request->filled('sort')) {
            $sort = $request->sort;
            switch ($sort) {
                case 'terbaru':
                    $laporan->orderBy('tanggal_lapor', 'desc');
                    break;
                case 'prioritas':
                    $laporan->orderBy('prioritas', 'desc'); // pastikan kolom ini ada
                    break;
                case 'status':
                    $laporan->orderBy('status');
                    break;
            }
        } else {
            $laporan->orderBy('tanggal_lapor', 'desc'); // default
        }

        $data = $laporan->paginate(10);

        return view('admin.laporan.index', compact('data'));
    }
}

{
    //
}
