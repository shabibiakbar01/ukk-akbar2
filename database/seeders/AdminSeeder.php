<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
{
    // Akun Admin
    Admin::create([
        'username' => 'admin_utama',
        'password' => bcrypt('admin123'),
        'role' => 'admin',
    ]);

    // Tambah data Kategori agar form tidak kosong
    \App\Models\Kategori::create(['nama_kategori' => 'Kebersihan']);
    \App\Models\Kategori::create(['nama_kategori' => 'Sarana Prasarana']);
}
}
