<?php
// app/Models/PengirimanBarang.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengirimanBarang extends Model
{
    protected $fillable = [
        'barang_id',
        'pengiriman_id',
        'jumlah',
        'status',
    ];

    public function pengiriman()
    {
        return $this->belongsTo(InputPengiriman::class, 'pengiriman_id');
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}

