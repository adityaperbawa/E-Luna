<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('kode_barang'); // contoh: N3.1.01.02.004

            // Tambahan level kode manual
            $table->string('kode_3')->nullable();
            $table->string('kode_4')->nullable();
            $table->string('kode_5')->nullable();

            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('sumber_id');
            $table->year('tahun_anggaran');
            $table->integer('stok');
            $table->integer('stok_minimum')->nullable();
            $table->string('satuan');
            $table->decimal('harga', 15, 2); // contoh: 1207000.00
            $table->decimal('total', 20, 2); // otomatis dari stok * harga
            $table->date('tanggal_kadaluwarsa')->nullable()->change();
            $table->string('status')->nullable();
            $table->timestamps();

            // Foreign Key
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
            $table->foreign('sumber_id')->references('id')->on('sumbers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
}
