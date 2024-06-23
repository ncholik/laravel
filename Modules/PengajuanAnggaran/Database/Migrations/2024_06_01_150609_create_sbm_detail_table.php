<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSbmDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sbm_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sbm_id')->constrained('sbm');
            $table->string('nama');
            $table->string('jumlah_satuan')->nullable();
            $table->string('satuan')->nullable();
            $table->string('harga_satuan')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('sbm_detail');
    }
}
