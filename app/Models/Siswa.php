<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use Notifiable;

    protected $table = 'siswa'; // Paksa Laravel pakai tabel siswa
    protected $primaryKey = 'nisn'; // Pakai NISN sebagai kunci
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nisn',
        'password',
        'nama_lengkap',
        'kelas',
    ];

    protected $hidden = [
        'password',
    ];
}
