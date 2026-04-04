<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {

    public function login() {
        return view('auth.login');
    }

    public function loginProcess(Request $request) {
        $credentials = $request->validate([
            'nisn'     => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('siswa.dashboard');
        }

        return back()->withErrors(['error' => 'NISN atau password salah']);
    }

    public function loginAdmin(Request $request) {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['error' => 'Username atau password admin salah']);
    }

    public function logout(Request $request) {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } else {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Berhasil logout.');
    }
}
