<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, HomeController, KuisController, GuruController};

// Rute Tamu (Login)
Route::get('/login', [AuthController::class, 'form'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Rute yang Membutuhkan Autentikasi (Login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Dashboard / Beranda
    Route::get('/', [HomeController::class, 'dashboard']);
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // Materi & Kuis (Siswa & Guru)
    Route::get('/materi/{materi?}', [HomeController::class, 'materi']);
    Route::get('/kuis/{materi}', [KuisController::class, 'show']);
    Route::post('/kuis/{materi}', [KuisController::class, 'submit']);

    // Nilai (khusus Siswa)
    Route::get('/nilai', [HomeController::class, 'nilai']);

    // Rute Khusus Guru (Laporan, Tambah Materi, & Kelola Siswa)
    Route::get('/guru/laporan', [GuruController::class, 'laporan']);
    Route::get('/guru/materi/create', [GuruController::class, 'create']);
    Route::post('/guru/materi', [GuruController::class, 'store']);

    // Rute Pendaftaran & Kelola Siswa oleh Guru
    Route::get('/guru/siswa', [GuruController::class, 'siswa']);
    Route::post('/guru/siswa', [GuruController::class, 'storeSiswa']);
});