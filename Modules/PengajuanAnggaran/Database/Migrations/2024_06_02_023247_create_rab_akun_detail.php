<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRabAkunDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rab_akun_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rab_detail_id')->constrained('rab_detail')->cascadeOnDelete();
            $table->integer('sbm_id');
            $table->string('sbm_text');
            $table->integer('sbm_detail_id');
            $table->string('sbm_detail_text');
            $table->string('jumlah')->nullable();
            $table->string('jumlah_satuan')->nullable();
            $table->string('jam')->nullable();
            $table->string('jam_satuan')->nullable();
            $table->string('frek')->nullable();
            $table->string('frek_satuan')->nullable();
            $table->string('total')->nullable();
            $table->string('total_satuan')->nullable();
            $table->string('harga_satuan')->nullable();
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
        Schema::dropIfExists('rab_akun_detail');
    }
}
