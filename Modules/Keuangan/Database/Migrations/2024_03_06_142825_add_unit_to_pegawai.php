<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUnitToPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Pegawais', function (Blueprint $table) {
            $table->unsignedBigInteger('unit_id')->nullable()->after('id_prodi');

            $table->foreign('unit_id')->references('id')->on('units')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Pegawais', function (Blueprint $table) {
            $table->dropForeign(['unit_id']);
        });
    }
}