<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiBarang extends Model
{
    use HasFactory;

    protected $table = 'lokasi_barangs';

    protected $fillable = [
        'barang_id',
        'gudang_id',
        'stok',
        'catatan',
    ];

    // Relasi ke tabel Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }


}
