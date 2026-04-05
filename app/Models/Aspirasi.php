<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Aspirasi extends Model
{
    protected $table = 'input_aspirasi';
    protected $primaryKey = 'id_pelaporan';
    protected $fillable = [
        'tgl_pelaporan',
        'nisn',
        'id_kategori',
        'ket',
        'foto',
        'status'
    ];

    public function siswa() {
        return $this->belongsTo(Siswa::class, 'nisn', 'nisn');
    }

    // Relasi ke kategori
    public function kategori() {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    // Relasi ke feedback
    public function feedback() {
        return $this->hasOne(Feedback::class, 'id_pelaporan', 'id_pelaporan');
    }
}
