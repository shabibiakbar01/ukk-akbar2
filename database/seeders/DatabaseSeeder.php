<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // HAPUS atau COMMENT baris di bawah ini agar tidak error column 'name' not found
        // User::factory(10)->create();

        // Panggil AdminSeeder yang sudah kamu buat
        $this->call([
            AdminSeeder::class,
        ]);
    }
}
