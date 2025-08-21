<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('usulan_logpals', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat');
            $table->date('tanggal_surat');
            $table->string('tahun_anggaran');
            $table->foreignId('sumber_id')->constrained('sumbers')->onDelete('cascade');
            $table->string('dokumen'); // Simpan nama file saja
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usulan_logpals');
    }
};

