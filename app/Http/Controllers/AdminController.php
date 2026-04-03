<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa; 
use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\Feedback;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // ================= DASHBOARD =================
    public function dashboard()
    {
        $totalSiswa = Siswa::count();
        $totalAspirasi = Aspirasi::count();
        $aspirasiPending = Aspirasi::where('status', 'pending')->count();
        $aspirasiSelesai = Aspirasi::where('status', 'selesai')->count();

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalAspirasi',
            'aspirasiPending',
            'aspirasiSelesai'
        ));
    }

    // ================= MANAJEMEN ASPIRASI =================

    public function dataAspirasi(Request $request)
    {
        $status = $request->get('status');
        $query = Aspirasi::with(['siswa', 'kategori']);

        if ($status) {
            $query->where('status', $status);
        }

        $aspirasis = $query->orderBy('tgl_pelaporan', 'desc')->get();

        $counts = [
            'all'     => Aspirasi::count(),
            'pending' => Aspirasi::where('status', 'pending')->count(),
            'proses'  => Aspirasi::where('status', 'proses')->count(),
            'selesai' => Aspirasi::where('status', 'selesai')->count(),
        ];

        return view('admin.aspirasi', compact('aspirasis', 'counts'));
    }

    public function tanggapi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'feedback' => 'required',
        ]);

        $aspirasi = Aspirasi::where('id_pelaporan', $id)->firstOrFail();
        $aspirasi->update(['status' => $request->status]);

        Feedback::updateOrCreate(
            ['id_pelaporan' => $id],
            [
                'id_admin' => auth()->guard('admin')->id(),
                'pesan' => $request->feedback,
                'tgl_feedback' => now(),
            ]
        );

        return redirect()->route('admin.aspirasi')->with('success', 'Berhasil menanggapi!');
    }

    public function destroyAspirasi($id)
    {
        $aspirasi = Aspirasi::where('id_pelaporan', $id)->first();

        if ($aspirasi) {
            $aspirasi->delete();
            return redirect()->route('admin.aspirasi')->with('success', 'Aspirasi berhasil dihapus.');
        }

        return redirect()->route('admin.aspirasi')->with('error', 'Gagal menghapus: Data tidak ditemukan.');
    }

    // ================= MANAJEMEN KATEGORI (FITUR BARU) =================

    public function dataKategori()
    {
        $kategoris = Kategori::orderBy('nama_kategori', 'asc')->get();
        return view('admin.kategori', compact('kategoris'));
    }

    public function storeKategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->back()->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    public function destroyKategori($id)
    {
        // Proteksi: Cek apakah kategori sedang digunakan oleh data aspirasi
        $isUsed = Aspirasi::where('id_kategori', $id)->exists();

        if ($isUsed) {
            return redirect()->back()->with('error', 'Kategori tidak bisa dihapus karena sedang digunakan oleh data aspirasi.');
        }

        Kategori::where('id_kategori', $id)->delete();
        return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
    }

    // ================= MANAJEMEN DATA SISWA =================

    public function dataSiswa()
    {
        $siswa = Siswa::orderBy('created_at', 'desc')->get();
        return view('admin.siswa', compact('siswa'));
    }

    public function storeSiswa(Request $request)
    {
        $request->validate([
            'nisn'          => 'required|string|unique:siswa,nisn',
            'nama_lengkap'  => 'required|string|max:255',
            'kelas'         => 'required|string|max:50',
            'password'      => 'required|min:6'
        ]);

        Siswa::create([
            'nisn'          => $request->nisn,
            'nama_lengkap'  => $request->nama_lengkap,
            'kelas'         => $request->kelas,
            'password'      => Hash::make($request->password),
        ]);

        return redirect()->route('admin.siswa')->with('success', 'Siswa berhasil ditambah!');
    }

    public function updatePassword(Request $request, $nisn)
    {
        $request->validate(['password' => 'required|min:6']);
        $siswa = Siswa::where('nisn', $nisn)->firstOrFail();
        $siswa->update(['password' => Hash::make($request->password)]);

        return redirect()->back()->with('success', 'Password berhasil direset!');
    }

    public function destroySiswa($nisn)
    {
        Siswa::where('nisn', $nisn)->delete();
        return redirect()->back()->with('success', 'Siswa berhasil dihapus!');
    }

    // ================= AUTH ADMIN =================
    public function loginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors(['username' => 'Login gagal.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}