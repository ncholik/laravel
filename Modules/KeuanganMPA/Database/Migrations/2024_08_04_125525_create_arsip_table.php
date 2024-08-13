<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArsipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arsip', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perencanaan_id');
            $table->unsignedBigInteger('realisasi_id');
            $table->integer('tahun');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('perencanaan_id')->references('id')->on('perencanaans')->onDelete('cascade');
            $table->foreign('realisasi_id')->references('id')->on('realisasis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arsip');
    }
}
