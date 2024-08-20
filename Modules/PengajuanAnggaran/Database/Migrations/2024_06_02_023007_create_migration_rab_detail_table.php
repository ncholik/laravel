<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMigrationRabDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rab_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rab_id')->constrained('rab')->cascadeOnDelete();
            $table->string('aktivitas');
            $table->string('lokasi');
            $table->string('penyedia');
            $table->string('durasi');
            $table->json('nama_peserta');
            $table->text('iku_id');
            $table->text('iku_text');
            $table->string('bukti');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rab_detail');
    }
}
