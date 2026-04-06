<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Siswa extends Authenticatable{
    use Notifiable;

    protected $table = 'siswa';
    protected $primaryKey = 'nisn';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['nisn', 'nama_lengkap', 'kelas', 'password'];
    protected $hidden = ['password']; 
    public function aspirasis() {
        return $this->hasMany(Aspirasi::class, 'nisn', 'nisn');
    }
}



