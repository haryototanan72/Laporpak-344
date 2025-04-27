<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Daftar semua user
    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.user.index', compact('users'));
    }

    // Ubah status aktif/tidak aktif
    public function updateStatus($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        $user = User::findOrFail($id);
        $user->status = $user->status === 'aktif' ? 'tidak aktif' : 'aktif';
        $user->save();
        return redirect()->back()->with('success', 'Status pengguna berhasil diubah!');
    }
}
