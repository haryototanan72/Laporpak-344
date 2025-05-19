<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\LaporanPublikController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\TrackReportController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\ProfileController;

// -----------------------------
// 🔹 Public Routes
// -----------------------------

// Landing page
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Public laporan submission
Route::post('/lapor', [LaporanPublikController::class, 'submit'])->name('submit.laporan');
Route::get('/laporan/masuk', [LaporanPublikController::class, 'index'])->name('laporan.masuk');

// Statistik (Uncomment if needed)
// Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik');

// Tracking routes
Route::get('/track', [TrackReportController::class, 'showTrackPage'])->name('track.show');
Route::post('/track/search', [TrackReportController::class, 'search'])->name('track.search');

// -----------------------------
// 🔒 Authenticated User Routes
// -----------------------------

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/user', [DashboardController::class, 'user'])->name('user.dashboard');

    // Profile Page
    Route::get('/profile', fn () => view('profile.profil'))->name('profile.index');
    Route::get('/profile/show', fn () => redirect()->route('profile.index'))->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // History Laporan User (lihat, edit, hapus, detail)
    Route::resource('laporan', \App\Http\Controllers\LaporanController::class)->except(['create', 'store']);

    // Form laporan
    Route::get('/lapor', fn () => view('profile.form_laporan'))->name('profile.form_laporan');

    // -----------------------------
    // 🔐 Admin Routes (Prefix & Name: admin.)
    // -----------------------------
    Route::prefix('admin')->name('admin.')->group(function () {

// Route untuk halaman tugas laporan petugas
Route::prefix('petugas')->name('petugas.')->group(function () {
    Route::get('laporan-tugas', [\App\Http\Controllers\Petugas\LaporanTugasController::class, 'index'])->name('laporan-tugas.index');
    Route::put('laporan-tugas/{id}/update', [\App\Http\Controllers\Petugas\LaporanTugasController::class, 'updateStatus'])->name('laporan-tugas.update');
});
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

        // Laporan Admin
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/{laporan}', [LaporanController::class, 'detail'])->name('laporan.detail');
        Route::put('/laporan/{laporan}/status', [LaporanController::class, 'updateStatus'])->name('laporan.updateStatus');

        // Manajemen Pengguna
        Route::get('/pengguna', [UserController::class, 'index'])->name('user.index');
        Route::post('/pengguna/{id}/update-status', [UserController::class, 'updateStatus'])->name('user.updateStatus');

        // CRUD Petugas
        Route::resource('petugas', PetugasController::class)
            ->except(['show'])
            ->parameters(['petugas' => 'petugas']);

        // Route pemberian tugas laporan ke petugas
        Route::post('petugas/{petugas}/kirim-laporan', [\App\Http\Controllers\Admin\PetugasLaporanController::class, 'store'])->name('petugas-laporan.store');
    });
});

// -----------------------------
// 🛡️ Auth Routes (Laravel Breeze/Fortify/etc.)
// -----------------------------
require __DIR__.'/auth.php';
