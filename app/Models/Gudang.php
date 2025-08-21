<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;

    protected $fillable = [
        'qr_code',
        'blok',
        'kategori_id',
        'keterangan'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
