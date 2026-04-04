<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Aspirasi;
use App\Models\Feedback;
use App\Models\Siswa;
use App\Models\Kategori;

class AdminController extends Controller {

    // Dashboard admin
    public function dashboard() {
        $totalAspirasi   = Aspirasi::count();
        $aspirasiPending = Aspirasi::where('status', 'pending')->count();
        $aspirasiSelesai = Aspirasi::where('status', 'selesai')->count();

        return view('admin.dashboard', compact('totalAspirasi', 'aspirasiPending', 'aspirasiSelesai'));
    }

    // List semua aspirasi
    public function dataAspirasi(Request $request) {
        $query = Aspirasi::with(['siswa', 'kategori', 'feedback'])
                    ->latest('tgl_pelaporan');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $aspirasis = $query->get();

        $counts = [
            'all'     => Aspirasi::count(),
            'pending' => Aspirasi::where('status', 'pending')->count(),
            'proses'  => Aspirasi::where('status', 'proses')->count(),
            'selesai' => Aspirasi::where('status', 'selesai')->count(),
        ];

        return view('admin.aspirasi', compact('aspirasis', 'counts'));
    }

    // Tanggapi aspirasi
    public function tanggapi(Request $request, $id) {
        $request->validate([
            'status'   => 'required',
            'feedback' => 'required',
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update(['status' => $request->status]);

         Feedback::updateOrCreate(
        ['id_pelaporan' => $id],
        [
            'pesan'        => $request->feedback,
            'tgl_feedback' => now(),
            'id_admin'     => Auth::guard('admin')->user()->id_admin, // ← tambah ini
        ]
    );

        return back()->with('success', 'Tanggapan berhasil disimpan!');
    }

    // Hapus aspirasi
    public function destroyAspirasi($id) {
        Aspirasi::findOrFail($id)->delete();
        return back()->with('success', 'Aspirasi berhasil dihapus.');
    }

    // Data siswa
    public function dataSiswa() {
        $siswa = Siswa::all();
        return view('admin.siswa', compact('siswa'));
    }

    // Tambah siswa
    public function storeSiswa(Request $request) {
        $request->validate([
            'nisn'         => 'required|unique:siswa,nisn',
            'nama_lengkap' => 'required',
            'kelas'        => 'required',
            'password'     => 'required|min:6',
        ]);

        Siswa::create([
            'nisn'         => $request->nisn,
            'nama_lengkap' => $request->nama_lengkap,
            'kelas'        => $request->kelas,
            'password'     => Hash::make($request->password),
        ]);

        return back()->with('success', 'Siswa berhasil ditambahkan!');
    }

    // Reset password siswa
    public function updatePassword(Request $request, $nisn) {
        $request->validate(['password' => 'required|min:6']);

        Siswa::where('nisn', $nisn)->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password berhasil direset!');
    }

    // Hapus siswa
    public function destroySiswa($nisn) {
        Siswa::where('nisn', $nisn)->delete();
        return back()->with('success', 'Siswa berhasil dihapus.');
    }

    // Data kategori
    public function dataKategori() {
        $kategoris = Kategori::all();
        return view('admin.kategori', compact('kategoris'));
    }

    // Tambah kategori
    public function storeKategori(Request $request) {
        $request->validate(['nama_kategori' => 'required']);
        Kategori::create(['nama_kategori' => $request->nama_kategori]);
        return back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Hapus kategori
    public function destroyKategori($id) {
        Kategori::findOrFail($id)->delete();
        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}
