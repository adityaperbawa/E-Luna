<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputPengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengirimans';

    protected $fillable = [
        'no_surat',
        'tanggal_surat',
        'tanggal_pengiriman',
        'tujuan_id',
        'lokasi_tujuan',
        'tahun',
        'dokumen_bast',
        'delivery_order',
        'no_wa',
        'stnk',
        'sim_driver',
        'foto_kendaraan',
        'unloading',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
        'tanggal_pengiriman' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke tujuan (kota).
     */
    public function tujuan()
    {
        return $this->belongsTo(Tujuan::class, 'tujuan_id');
    }
    public function pengirimanBarang()
    {
        return $this->hasMany(PengirimanBarang::class, 'pengiriman_id');
    }
}
