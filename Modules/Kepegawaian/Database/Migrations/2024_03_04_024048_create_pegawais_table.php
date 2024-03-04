<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 19)->nullable();
            $table->string('noid', 15)->nullable();
            $table->string('nama', 100);
            $table->bigInteger('id_staff')->unsigned()->nullable();
            $table->bigInteger('id_jurusan')->unsigned()->nullable();
            $table->bigInteger('id_prodi')->unsigned()->nullable();
            $table->string('jenis_kelamin', 1)->nullable();
            $table->string('agama', 100)->nullable();
            $table->string('no_tlp', 30)->nullable();
            $table->string('tmp_lahir', 20)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('gol_darah', 5)->nullable();
            $table->string('gelar_dpn', 10)->nullable();
            $table->string('gelar_blk', 20)->nullable();
            $table->string('status_kawin', 2)->nullable();
            $table->string('kelurahan', 50)->nullable();
            $table->string('kecamatan', 50)->nullable();
            $table->string('kota', 50)->nullable();
            $table->string('provinsi', 50)->nullable();

            $table->string('askes', 30)->nullable();
            $table->string('kode_dosen', 10)->nullable();
            $table->string('npwp', 30)->nullable();
            $table->string('nidn', 20)->nullable();

            $table->string('username', 200)->nullable();
            $table->string('id_dosen_feeder', 50)->nullable();
            $table->string('id_status_dosen_feeder', 50)->nullable();
            $table->string('id_reg_dosen_feeder', 50)->nullable();

            $table->string('status_karyawan', 1)->nullable();


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
        Schema::dropIfExists('pegawais');
    }
}
