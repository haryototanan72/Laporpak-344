<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\LaporanController;

// Tampilkan landing.blade.php di halaman utama
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Semua route setelah login
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard umum
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Dashboard Admin
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])
        ->name('admin.dashboard');

    // Dashboard User
    Route::get('/dashboard/user', [DashboardController::class, 'user'])
        ->name('user.dashboard');

    // Route laporan untuk admin (akses hanya admin)
    Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    });

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
