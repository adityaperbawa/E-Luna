<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tujuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kab_kota',
        'instansi',
        'alamat',
    ];
    public function permohonans()
    {
        return $this->hasMany(Permohonan::class);
    }
}
