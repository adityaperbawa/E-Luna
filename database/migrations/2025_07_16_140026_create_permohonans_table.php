<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permohonans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tujuan_id')
                  ->constrained('tujuans')
                  ->onDelete('cascade');

            $table->string('no_surat', 255);
            $table->date('tanggal_surat');
            $table->year('tahun_surat');
            $table->string('keperluan');
            $table->string('dokumen');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permohonans');
    }
};
