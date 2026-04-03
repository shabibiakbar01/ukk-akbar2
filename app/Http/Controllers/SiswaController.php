<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Aspirasi; // Tambahkan ini agar tidak error saat memanggil Aspirasi::where

class SiswaController extends Controller
{
    public function index()
{
    $nisn = Auth::user()->nisn;

    $aspirasiSaya = Aspirasi::with(['kategori'])
                    ->where('nisn', $nisn)
                    ->orderBy('tgl_pelaporan', 'desc')
                    ->get();

    $totalAspirasi = $aspirasiSaya->count();


    // Jika file ada di resources/views/dashboard.blade.php
    return view('siswa/dashboard', compact('aspirasiSaya', 'totalAspirasi'));
}

public function logout(Request $request)
{
    Auth::logout(); // Logout user (siswa)
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
}
}
