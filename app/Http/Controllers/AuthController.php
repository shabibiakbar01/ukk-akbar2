<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    // Proses Login untuk SISWA
    // Proses Login untuk SISWA
public function loginProcess(Request $request)
{
    $credentials = $request->validate([
        'nisn' => 'required',
        'password' => 'required'
    ]);

    if (Auth::guard('web')->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/siswa/dashboard');
    }

    // Gunakan back()->withErrors agar terdeteksi oleh @if($errors->any())
    return back()->withErrors(['error' => 'NISN atau password salah']);
}

// Proses Login untuk ADMIN
public function loginAdmin(Request $request)
{
    $credentials = $request->validate([
        'username' => 'required',
        'password' => 'required'
    ]);

    if (Auth::guard('admin')->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/admin/dashboard');
    }

    // Gunakan back()->withErrors
    return back()->withErrors(['error' => 'Username atau password admin salah']);
}

    // Logout
    public function logout(Request $request)
    {
        // Pastikan logout spesifik sesuai guard yang sedang aktif
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
        } else {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
