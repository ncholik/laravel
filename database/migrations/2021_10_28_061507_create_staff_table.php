<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
			$table->string('nama');
            $table->timestamps();
        });
		
		// Insert some stuff
		DB::table('staffs')->insert([
			array(
				'id'	=>	1,
				'nama'	=> 'Subbag Umum'
			),
			array(
				'id'	=>	2,
				'nama'	=> 'Teknisi Lab'
			),
			array(
				'id'	=>	3,
				'nama'	=> 'Pranata Laboratorium Pendidikan'
			),
			array(
				'id'	=>	4,
				'nama'	=> 'Dosen'
			),
			array(
				'id'	=>	5,
				'nama'	=> 'Keamanan'
			),
			array(
				'id'	=>	6,
				'nama'	=> 'Sopir'
			),
			array(
				'id'	=>	7,
				'nama'	=> 'Administrasi'
			),
			array(
				'id'	=>	9,
				'nama'	=> 'Pramu Kantor'
			),
			array(
				'id'	=>	10,
				'nama'	=> 'Tenaga Penunjang'
			),
			array(
				'id'	=>	11,
				'nama'	=> 'Perpustakaan'
			),
			array(
				'id'	=>	12,
				'nama'	=> 'Subbag Perencanaan Dan Kerjasama'
			),
			array(
				'id'	=>	13,
				'nama'	=> 'Unit Pelayanan Pengadaan'
			),
			array(
				'id'	=>	14,
				'nama'	=> 'Arsiparis'
			),
			array(
				'id'	=>	15,
				'nama'	=> 'Upt Sistem Informasi'
			),
			array(
				'id'	=>	16,
				'nama'	=> 'Teknisi Umum'
			),
			array(
				'id'	=>	17,
				'nama'	=> 'Parkir'
			),
			array(
				'id'	=>	18,
				'nama'	=> 'Subbag Keuangan'
			),
			array(
				'id'	=>	19,
				'nama'	=> 'Subbag Kepegawaian'
			),
			array(
				'id'	=>	20,
				'nama'	=> 'Subbag Tata Usaha'
			),
			array(
				'id'	=>	21,
				'nama'	=> 'Subbag Akademik'
			),
			array(
				'id'	=>	22,
				'nama'	=> 'Administrasi Jurusan'
			),
			array(
				'id'	=>	23,
				'nama'	=> 'Subbag Gudang Dan Perlengkapan'
			),
			array(
				'id'	=>	24,
				'nama'	=> 'Administrasi Program Studi'
			),
			array(
				'id'	=>	25,
				'nama'	=> 'Staff Khusus'
			),
			array(
				'id'	=>	26,
				'nama'	=> 'P4mp'
			),
			array(
				'id'	=>	27,
				'nama'	=> 'P3m'
			),
			array(
				'id'	=>	28,
				'nama'	=> 'Upt Bahasa'
			),
			array(
				'id'	=>	29,
				'nama'	=> 'Upt Bimbingan Dan Konseling'
			),
			array(
				'id'	=>	30,
				'nama'	=> 'Pengelola Sistem Dan Jaringan'
			),
			array(
				'id'	=>	31,
				'nama'	=> 'Subbag Kemahasiswaan'
			),
			array(
				'id'	=>	32,
				'nama'	=> 'Perawat'
			),
			array(
				'id'	=>	33,
				'nama'	=> 'Koordinator Keamanan'
			),
			array(
				'id'	=>	34,
				'nama'	=> 'Koordinator Parkir'
			),
			array(
				'id'	=>	35,
				'nama'	=> 'Pengelola Kepegawaian'
			),
			array(
				'id'	=>	36,
				'nama'	=> 'Staf Poliklinik'
			),
			array(
				'id'	=>	37,
				'nama'	=> 'Pengelola Laman / Web'
			),
			array(
				'id'	=>	38,
				'nama'	=> 'Pengelola Keuangan'
			),
			array(
				'id'	=>	99,
				'nama'	=> 'Lain-lain'
			),
			array(
				'id'	=>	999,
				'nama'	=> 'Mahasiswa'
			)
		]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
