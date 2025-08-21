<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tujuan_id',
        'no_surat',
        'tanggal_surat',
        'tahun_surat',
        'keperluan',
        'dokumen',
    ];
    protected $casts = [
    'tanggal_surat' => 'date',
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
];

    /**
     * Relasi ke tabel tujuans.
     * Setiap permohonan dimiliki oleh satu tujuan (kab/kota + instansi)
     */
    public function tujuan()
    {
        return $this->belongsTo(Tujuan::class, 'tujuan_id');
    }

}
