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
    Schema::create('feedback', function (Blueprint $table) {
        $table->id('id_feedback'); // PK sesuai ERD

        // Relasi ke input_aspirasi
        $table->unsignedBigInteger('id_pelaporan');
        $table->foreign('id_pelaporan')->references('id_pelaporan')->on('input_aspirasi')->onDelete('cascade');

        // Relasi ke admin
        $table->unsignedBigInteger('id_admin');
        $table->foreign('id_admin')->references('id_admin')->on('admins')->onDelete('cascade');

        $table->text('pesan');
        $table->dateTime('tgl_feedback');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
