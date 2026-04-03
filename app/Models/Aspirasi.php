<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $table = 'input_aspirasi';
    protected $primaryKey = 'id_pelaporan';
    public $timestamps = true;

    protected $fillable = [
    'tgl_pelaporan',
    'nisn',
    'id_kategori',
    'ket',
    'status',
    'foto' 
];

    public function siswa()
{
    // Merujuk ke Model Siswa, bukan User
    return $this->belongsTo(Siswa::class, 'nisn', 'nisn');
}

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    // TAMBAHKAN RELASI INI
    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'id_pelaporan', 'id_pelaporan');
    }
}
