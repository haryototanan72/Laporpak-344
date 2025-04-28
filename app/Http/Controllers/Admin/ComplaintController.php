<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    // Tampilkan daftar laporan dengan filter
    public function index(Request $request)
    {
        // Hanya admin yang boleh akses
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        $query = Laporan::with('user');

        // Filter status jika dipilih
        if ($request->filled('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Urutkan berdasarkan tanggal input
        if ($request->filled('tanggal') && $request->tanggal != '') {
            if ($request->tanggal == 'terbaru') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->tanggal == 'terlama') {
                $query->orderBy('created_at', 'asc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $laporans = $query->paginate(20);
        return view('admin.laporan.index', compact('laporans'));
    }

    // Tampilkan detail laporan
    public function detail($id)
    {
        // Hanya admin yang boleh akses
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        $laporan = Laporan::with('user')->findOrFail($id);
        return view('admin.laporan.detaillaporan', compact('laporan'));
    }

    // Update status laporan
    public function updateStatus(Request $request, $id)
    {
        // Hanya admin yang boleh akses
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        $laporan = Laporan::findOrFail($id);
        $laporan->status = $request->status;
        $laporan->save();

        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui!');
    }

    // Hapus laporan
    public function destroy($id)
    {
        // Hanya admin yang boleh akses
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
