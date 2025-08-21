<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengiriman_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');
            $table->foreignId('pengiriman_id')->nullable()->constrained('pengirimans')->onDelete('cascade'); // ✅ relasi benar
            $table->integer('jumlah')->default(1);
            $table->string('status')->default('dikirim');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengiriman_barangs');
    }
};
