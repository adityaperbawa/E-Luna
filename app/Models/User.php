<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Mass assignable fields
    protected $fillable = [
        'name', 'email', 'password', 'role', 'jabatan'

    ];

    


    // Hidden fields saat output ke array/JSON
    protected $hidden = [
        'password',
    ];

    // Jika mau, cast tipe data
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
