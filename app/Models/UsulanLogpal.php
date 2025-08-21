<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsulanLogpal extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_surat',
        'tanggal_surat',
        'tahun_anggaran',
        'sumber_id',
        'dokumen',
    ];

    // Relasi ke Sumber
    public function sumberData()
    {
        return $this->belongsTo(Sumber::class, 'sumber_id'); 
    }
}
