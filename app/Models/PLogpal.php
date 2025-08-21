<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PLogpal extends Model
{
    use HasFactory;

    protected $table = 'p_logpal';

    protected $fillable = [
        'penerimaan',
        'usulan_id',
        'no_surat_bast',
        'tanggal_surat',
        'tanggal_masuk',
        'nama_pengirim',
        'dokumen_bast',
        'delivery_order',
        'no_whatsapp',
        'stnk',
        'sim_driver',
        'foto_kendaraan',
        'foto_unloading',
    ];

    public function usulan()
    {
        return $this->belongsTo(UsulanLogpal::class, 'usulan_id');
    }
}
