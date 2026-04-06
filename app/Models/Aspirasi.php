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
        'status',
    ];
}
