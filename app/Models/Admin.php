<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';
    protected $primaryKey = 'id_admin';
    protected $fillable = [
        'username', 
        'role',
        'passsword',
        ];
        protected $hidden = ['password'];
}
