<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Siswa::create([
        'nisn' => '123456', // Ini ID untuk login
        'nama_lengkap' => 'AKBAR SHABIBI',
        'kelas' => 'XII RPL 3',
        'password' => bcrypt('akbar123'), // Password harus di-encrypt
    ]);

     \App\Models\Siswa::create([
        'nisn' => '1234567', // Ini ID untuk login
        'nama_lengkap' => 'SATRIA HUTAMA',
        'kelas' => 'XII RPL 3',
        'password' => bcrypt('satria123'), // Password harus di-encrypt
    ]);
    }
}
