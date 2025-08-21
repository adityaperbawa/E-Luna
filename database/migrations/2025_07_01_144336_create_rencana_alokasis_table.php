<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rencana_alokasis', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat');
            $table->date('tanggal');
            $table->string('tahun', 4); // disimpan sebagai string 4 digit
            $table->string('dokumen'); // nama file (bisa pdf/doc/jpeg)
            $table->string('status')->nullable(); // nilai: 'disetujui', 'ditolak'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rencana_alokasis');
    }
};
