<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('realisasis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('progres', 100);
            $table->bigInteger('realisasi');
            $table->char('laporan_keuangan', 150);
            $table->char('laporan_kegiatan', 150);
            $table->char('ketercapian_output', 100);
            $table->date('tanggal_kontrak');
            $table->date('tanggal_pembayaran');
            $table->unsignedBigInteger('sub_perencanaan_id');
            $table->timestamps();
            
            $table->foreign('sub_perencanaan_id')->references('id')->on('sub_perencanaans')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('realisasis', function (Blueprint $table) {
            $table->dropForeign(['sub_perencanaan_id']);
        });
    }
};
