<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permohonan_baratas', function (Blueprint $table) {
            $table->id();

            // Relasi ke tujuans (kota)
            $table->foreignId('tujuan_id')
                ->constrained('tujuans')
                ->onDelete('cascade');

            // Kolom lainnya
            $table->date('tanggal_kejadian');
            $table->string('kejadian');
            $table->string('no_surat');

            // Status: 'disetujui', 'ditolak', atau null
            $table->string('status')->nullable();
            $table->string('dokumen')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permohonan_baratas');
    }
};
