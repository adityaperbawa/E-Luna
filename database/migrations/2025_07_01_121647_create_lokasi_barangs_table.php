<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lokasi_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade'); // Sinkron dengan barang
            $table->foreignId('gudang_id')->constrained('gudangs')->onDelete('cascade'); // Sinkron dengan gudang
            $table->integer('stok'); // stok di lokasi ini
            $table->string('catatan')->nullable(); // opsional
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lokasi_barangs');
    }
};
