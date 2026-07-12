<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GejalaController;
use App\Http\Controllers\Admin\HamaController;
use App\Http\Controllers\Admin\PenyakitController;
use App\Http\Controllers\Admin\RuleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'home'])->name('home');
Route::get('/tentang', [LandingController::class, 'tentang'])->name('tentang');
Route::get('/cara-kerja', [LandingController::class, 'caraKerja'])->name('cara-kerja');

Route::get('/deteksi', [DiagnosisController::class, 'index'])->name('deteksi');
Route::get('/deteksi/targets', [DiagnosisController::class, 'targets'])->name('deteksi.targets');
Route::get('/deteksi/target/{jenis}/{targetId}/gejala', [DiagnosisController::class, 'symptomsForTarget'])->name('deteksi.symptoms');
Route::middleware('throttle:60,1')->group(function () {
    Route::post('/deteksi/hitung', [DiagnosisController::class, 'calculate'])->name('deteksi.calculate');
    Route::post('/deteksi/simpan', [DiagnosisController::class, 'store'])->name('deteksi.store');
});

Route::middleware(['auth', 'role:pengguna'])->group(function () {
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
});

Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('gejala', GejalaController::class)->except(['show']);
    Route::resource('penyakit', PenyakitController::class);
    Route::resource('hama', HamaController::class);
    Route::get('rules/export', [RuleController::class, 'export'])->name('rules.export');
    Route::resource('rules', RuleController::class)->except(['show']);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class)->except(['show']);
});

require __DIR__.'/auth.php';
