<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AspirasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- HALAMAN UTAMA ---
Route::get('/', function () {
    return view('welcome');
});

// --- AKSES LOGIN ---
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.siswa.process');
Route::post('/admin/login', [AuthController::class, 'loginAdmin'])->name('login.admin.process');

// --- AKSES SISWA (Auth via Table Siswa) ---
Route::middleware(['auth'])->group(function () {
    Route::get('/siswa/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');

    // --- MANAJEMEN ASPIRASI SISWA ---
    Route::get('/aspirasi/riwayat', [AspirasiController::class, 'index'])->name('aspirasi.index');
    Route::get('/aspirasi/buat', [AspirasiController::class, 'create'])->name('aspirasi.create');
    Route::post('/aspirasi/simpan', [AspirasiController::class, 'store'])->name('aspirasi.store');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// --- AKSES ADMIN (Auth via Table Admin) ---
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // --- MANAJEMEN ASPIRASI ADMIN ---
    Route::get('/admin/aspirasi', [AdminController::class, 'dataAspirasi'])->name('admin.aspirasi');
    Route::post('/admin/aspirasi/tanggapi/{id}', [AdminController::class, 'tanggapi'])->name('admin.tanggapi');
    Route::delete('/admin/aspirasi/delete/{id}', [AdminController::class, 'destroyAspirasi'])->name('admin.aspirasi.destroy');

    // --- MANAJEMEN DATA SISWA (ADMIN) ---
    Route::get('/admin/siswa', [AdminController::class, 'dataSiswa'])->name('admin.siswa');
    Route::post('/admin/siswa/store', [AdminController::class, 'storeSiswa'])->name('admin.siswa.store');
    Route::delete('/admin/siswa/delete/{nisn}', [AdminController::class, 'destroySiswa'])->name('admin.siswa.destroy');

    // Route Khusus Reset Password (Sangat Penting agar Error Hilang)
    Route::put('/admin/siswa/update-password/{nisn}', [AdminController::class, 'updatePassword'])->name('admin.siswa.updatePassword');

    Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::get('/admin/kategori', [AdminController::class, 'dataKategori'])->name('admin.kategori');
    Route::post('/admin/kategori', [AdminController::class, 'storeKategori'])->name('admin.kategori.store');
    Route::delete('/admin/kategori/{id}', [AdminController::class, 'destroyKategori'])->name('admin.kategori.destroy');
});
