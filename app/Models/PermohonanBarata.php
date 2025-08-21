<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanBarata extends Model
{
    use HasFactory;

    // (opsional) Jika nama tabel mengikuti konvensi, baris ini boleh dihapus
    protected $table = 'permohonan_baratas';

    /**
     * Kolom yang boleh di‑isi massal (create / update).
     */
    protected $fillable = [
        'tujuan_id',
        'tanggal_kejadian',
        'kejadian',
        'no_surat',
        'status',          // 'disetujui' | 'ditolak' | null
        'dokumen',         // << tambahkan ini
    ];

    /**
     * Cast agar tanggal_kejadian otomatis menjadi Carbon.
     */
    protected $casts = [
        'tanggal_kejadian' => 'date',
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
    ];

    /* -------------------------------------------------
     *  Relasi
     * -------------------------------------------------*/

    /**
     * Satu permohonan dimiliki oleh satu tujuan (kota).
     */
    public function tujuan()
    {
        return $this->belongsTo(Tujuan::class, 'tujuan_id');
    }
}
