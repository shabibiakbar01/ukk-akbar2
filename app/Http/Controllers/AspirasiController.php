<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Aspirasi;
use App\Models\Kategori;

class AspirasiController extends Controller
{
    /**
     * Menampilkan riwayat aspirasi milik siswa yang sedang login
     */
    public function index()
    {
        $aspirasis = Aspirasi::with(['kategori', 'feedback'])
            ->where('nisn', Auth::user()->nisn)
            ->latest()
            ->get();

        return view('siswa.riwayat', compact('aspirasis'));
    }

    /**
     * Menampilkan halaman form buat aspirasi
     */
    public function create()
    {
        // Tetap ambil data kategori jika sewaktu-waktu dibutuhkan di view
        $kategoris = Kategori::all();
        return view('siswa.buat_aspirasi', compact('kategoris'));
    }

    /**
     * Memproses penyimpanan aspirasi baru
     */
    /**
     * Memproses penyimpanan aspirasi baru dengan dukungan unggah foto
     */
    public function store(Request $request)
{
    // 1. Validasi: Pastikan id_kategori ada di tabel kategori
    $request->validate([
        'id_kategori' => 'required',
        'isi_aspirasi' => 'required|min:10', // Aturan minimal 10 karakter
        'foto' => 'nullable|image|max:2048',
    ], [
        // Pesan kustom dalam bahasa Indonesia
        'isi_aspirasi.min' => 'Detail aspirasi terlalu singkat, minimal harus 10 karakter.',
        'isi_aspirasi.required' => 'Detail aspirasi tidak boleh kosong.',
    ]);

    

    // 2. Logika Unggah Foto
    $nama_file = null;
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('storage/foto_aspirasi'), $nama_file);
    }

    Aspirasi::create([
        'tgl_pelaporan' => now(),
        'nisn'          => Auth::user()->nisn,
        'id_kategori'   => $request->id_kategori, // Ambil ID langsung
        'ket'           => $request->isi_aspirasi, // Sesuai name="isi_aspirasi" di textarea
        'status'        => 'pending',
        'foto'          => $nama_file,
    ]);

    return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil terkirim!');
}
}
