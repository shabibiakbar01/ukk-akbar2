<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AspirasiController;

// --- HALAMAN UTAMA ---
Route::get('/', function () {
    return view('welcome');
});

// --- LOGIN ---
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.siswa.process');
Route::post('/admin/login', [AuthController::class, 'loginAdmin'])->name('login.admin.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// --- SISWA (tanpa middleware, bisa akses via URL) ---
Route::get('/siswa/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');
Route::get('/aspirasi/riwayat', [AspirasiController::class, 'index'])->name('aspirasi.index');
Route::get('/aspirasi/buat', [AspirasiController::class, 'create'])->name('aspirasi.create');
Route::post('/aspirasi/simpan', [AspirasiController::class, 'store'])->name('aspirasi.store');

// --- ADMIN (tanpa middleware, bisa akses via URL) ---
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/aspirasi', [AdminController::class, 'dataAspirasi'])->name('admin.aspirasi');
Route::post('/admin/aspirasi/tanggapi/{id}', [AdminController::class, 'tanggapi'])->name('admin.tanggapi');
Route::delete('/admin/aspirasi/delete/{id}', [AdminController::class, 'destroyAspirasi'])->name('admin.aspirasi.destroy');
Route::get('/admin/siswa', [AdminController::class, 'dataSiswa'])->name('admin.siswa');
Route::post('/admin/siswa/store', [AdminController::class, 'storeSiswa'])->name('admin.siswa.store');
Route::delete('/admin/siswa/delete/{nisn}', [AdminController::class, 'destroySiswa'])->name('admin.siswa.destroy');
Route::put('/admin/siswa/update-password/{nisn}', [AdminController::class, 'updatePassword'])->name('admin.siswa.updatePassword');
Route::get('/admin/kategori', [AdminController::class, 'dataKategori'])->name('admin.kategori');
Route::post('/admin/kategori', [AdminController::class, 'storeKategori'])->name('admin.kategori.store');
Route::delete('/admin/kategori/{id}', [AdminController::class, 'destroyKategori'])->name('admin.kategori.destroy');
