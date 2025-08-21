<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengirimans', function (Blueprint $table) {
            $table->id();

            $table->string('no_surat');
            $table->date('tanggal_surat');
            $table->date('tanggal_pengiriman');

            // Relasi ke tujuan
            $table->foreignId('tujuan_id')
                ->constrained('tujuans')
                ->onDelete('cascade');

            $table->enum('lokasi_tujuan', ['sama', 'tidak sama'])->default('sama'); // checkbox value

            $table->year('tahun');

            // Dokumen (boleh null, tipe bebas)
            $table->string('dokumen_bast')->nullable();
            $table->string('delivery_order')->nullable();
            $table->string('no_wa')->nullable();
            $table->string('stnk')->nullable();
            $table->string('sim_driver')->nullable();
            $table->string('foto_kendaraan')->nullable();
            $table->string('unloading')->nullable(); // bisa foto/video

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengirimans');
    }
};
