<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::create('input_aspirasi', function (Blueprint $table) {
        $table->id('id_pelaporan'); // PK sesuai ERD
        $table->dateTime('tgl_pelaporan'); // Sesuai ERD

        // FK ke Siswa
        $table->string('nisn',20);
        $table->foreign('nisn')->references('nisn')->on('siswa')->onDelete('cascade');

        // FK ke Kategori
        $table->unsignedBigInteger('id_kategori');
        $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');

        $table->text('ket'); // Menggantikan isi_aspirasi sesuai ERD
        $table->enum('status', ['pending', 'proses', 'selesai', 'ditolak'])->default('pending');
        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirasi');
    }
};
