<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('input_aspirasi', function (Blueprint $table) {
            $table->id('id_pelaporan');
            $table->dateTime('tgl_pelaporan');
            $table->unsignedBigInteger('nisn');
            $table->unsignedBigInteger('id_kategori');               
            $table->text('ket');
            $table->string('foto')->nullable();
            $table->enum('status', ['pending', 'proses', 'selesai']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input_aspirasi');
    }
};
