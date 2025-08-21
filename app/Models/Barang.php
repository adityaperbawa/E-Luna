<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'kode_3',
        'kode_4',
        'kode_5',
        'kategori_id',
        'sumber_id',
        'tahun_anggaran',
        'stok',
        'stok_minimum',
        'satuan',
        'harga',
        'total',
        'tanggal_kadaluwarsa',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function sumber()
    {
        return $this->belongsTo(Sumber::class);
    }
}
