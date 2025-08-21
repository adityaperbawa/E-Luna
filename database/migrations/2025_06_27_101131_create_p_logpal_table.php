<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePLogpalTable extends Migration
{
    public function up()
    {
        Schema::create('p_logpal', function (Blueprint $table) {
            $table->id();

            // 2. penerimaan: logistik atau peralatan
            $table->enum('penerimaan', ['logistik', 'peralatan']);

            // 3. rencana_penerimaan: relasi opsional ke usulan_logpals
            $table->unsignedBigInteger('usulan_id')->nullable(); // relasi opsional
            $table->foreign('usulan_id')->references('id')->on('usulan_logpals')->onDelete('set null');

            // 4. No Surat BAST
            $table->string('no_surat_bast')->nullable();

            // 5. Tanggal Surat
            $table->date('tanggal_surat')->nullable();

            // 6. Tanggal Masuk
            $table->date('tanggal_masuk')->nullable();

            // 7. Nama Pengirim
            $table->string('nama_pengirim')->nullable();

            // 8. Dokumen BAST
            $table->string('dokumen_bast')->nullable();

            // 9. Delivery Order
            $table->string('delivery_order')->nullable();

            // 10. No Whatsapp
            $table->string('no_whatsapp')->nullable();

            // 11. STNK
            $table->string('stnk')->nullable();

            // 12. SIM Driver
            $table->string('sim_driver')->nullable();

            // 13. Foto Kendaraan
            $table->string('foto_kendaraan')->nullable();

            // 14. Foto/Video Unloading
            $table->string('foto_unloading')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('p_logpal');
    }
}
