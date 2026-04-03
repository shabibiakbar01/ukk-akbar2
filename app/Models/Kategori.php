<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    // Tambahkan baris ini untuk memaksa menggunakan nama tabel 'kategori'
    protected $table = 'kategori';

    protected $primaryKey = 'id_kategori';

    protected $fillable = ['nama_kategori'];

    public $timestamps = false;
}
