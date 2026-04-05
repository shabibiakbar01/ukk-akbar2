<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    protected $primaryKey = 'id_feedback';
    protected $fillable = [
        'id_pelaporan',
        'id_admin',
        'ket',
        'tgl_feedback',
    ];
}
