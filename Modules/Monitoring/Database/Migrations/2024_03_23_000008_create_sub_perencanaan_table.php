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
        Schema::create('sub_perencanaans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('kegiatan', 150);
            $table->enum('metode_pengadaan', [
                'Swakelola',
                'Pengadaan Langsung',
                'E-purchasing',
                'Tender',
                'Seleksi',
                'Penunjukan Langsung',
            ]);
            $table->char('satuan', 50);
            $table->integer('volume');
            $table->integer('harga_satuan');
            $table->char('output');
            $table->date('rencana_mulai');
            $table->date('rencana_bayar');
            $table->char('file_hps', 150);
            $table->char('file_kak', 150);
            $table->unsignedBigInteger('perencanaan_id');
            $table->unsignedBigInteger('pic_id');
            $table->unsignedBigInteger('ppk_id');
            $table->bigInteger('pp_id')->nullable();
            $table->enum('jenis', [
                'Barang',
                'Jasa Konsultansi',
                'Operasional',
                'Pekerjaan Konstruksi',
            ]);
            $table->timestamps();

            $table->foreign('perencanaan_id')->references('id')->on('perencanaans')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('pic_id')->references('id')->on('pegawais')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('ppk_id')->references('id')->on('pegawais')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_perencanaans', function (Blueprint $table) {
            $table->dropForeign(['perencanaan_id']);
            $table->dropForeign(['pic_id']);
            $table->dropForeign(['ppk_id']);
        });
    }
};
