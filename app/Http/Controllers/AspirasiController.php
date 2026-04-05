<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Aspirasi;
use App\Models\Kategori;

class AspirasiController extends Controller
{
    public function create() {
        $kategoris = Kategori::all();
        return view('siswa.buat_aspirasi', compact('kategoris'));
    }

    public function store(Request $request) {
        $request->validate([
            'id_kategori' => 'required',
            'isi_aspirasi' => 'required|min:10',
            'foto' => 'nullable|image|max:2048'
        ]);

        $namaFoto = null;
        if ($request->hasFile('foto')) {
            $namaFoto = $request->file('foto')->store('foto_aspirasi', 'public');
            $namaFoto = basename($namaFoto);
        }

        Aspirasi::create([
            'nisn'          => Auth::user()->nisn ?? '0000000000',
            'id_kategori'   => $request->id_kategori,
            'ket'           => $request->isi_aspirasi,
            'foto'          => $namaFoto,
            'status'        => 'pending',
            'tgl_pelaporan' => now(),
        ]);

        return redirect()->route('aspirasi.create')
                         ->with('success', 'Aspirasi berhasil dikirim!');
    }

    public function index() {
        $aspirasis = Aspirasi::with(['kategori', 'feedback'])
                        ->where('nisn', Auth::user()->nisn ?? '0000000000')
                        ->latest('tgl_pelaporan')
                        ->get();

        return view('siswa.riwayat', compact('aspirasis'));
    }
}
