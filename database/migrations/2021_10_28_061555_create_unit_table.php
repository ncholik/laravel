<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
			$table->string('nama');
            $table->timestamps();
        });
		
		// Insert some stuff
		DB::table('units')->insert([
			array(
				'id'	=>	13,
				'nama'	=> 'Bagian Umum Dan Keuangan'
			),
			array(
				'id'	=>	14,
				'nama'	=> 'Sub Bagian Keuangan'
			),
			array(
				'id'	=>	16,
				'nama'	=> 'Sub Bagian Umum Dan Kepegawaian'
			),
			array(
				'id'	=>	18,
				'nama'	=> 'Bagian Akademik, Kemahasiswaan, Perencanaan, Dan Sistem Informasi'
			),
			array(
				'id'	=>	19,
				'nama'	=> 'Sub Bagian Akademik Dan Kemahasiswaan'
			),
			array(
				'id'	=>	20,
				'nama'	=> 'Sub Bagian Perencanaan, Dan Sistem Informasi'
			),
			array(
				'id'	=>	74,
				'nama'	=> 'Jurusan Teknik Informatika'
			),
			array(
				'id'	=>	75,
				'nama'	=> 'Jurusan Teknik Mesin'
			),
			array(
				'id'	=>	76,
				'nama'	=> 'Jurusan Teknik Sipil'
			),
			array(
				'id'	=>	77,
				'nama'	=> 'Program Studi Teknik Informatika'
			),
			array(
				'id'	=>	78,
				'nama'	=> 'Program Studi Teknik Mesin'
			),
			array(
				'id'	=>	79,
				'nama'	=> 'Program Studi Teknik Sipil'
			),
			array(
				'id'	=>	80,
				'nama'	=> 'Program Studi Teknologi Pengolahan Hasil Ternak'
			),
			array(
				'id'	=>	81,
				'nama'	=> 'Program Studi Agribisnis'
			),
			array(
				'id'	=>	82,
				'nama'	=> 'Program Studi Manajemen Bisnis Pariwisata'
			),
			array(
				'id'	=>	83,
				'nama'	=> 'Upt Perpustakaan'
			),
			array(
				'id'	=>	84,
				'nama'	=> 'Pusat Penelitian Dan Pengabdian Masyarakat'
			),
			array(
				'id'	=>	85,
				'nama'	=> 'Pusat Penjaminan Mutu'
			),
			array(
				'id'	=>	86,
				'nama'	=> 'Unit Kewirausahaan Dan Kerjasama'
			),
			array(
				'id'	=>	87,
				'nama'	=> 'Unit Job Placement Centre'
			),
			array(
				'id'	=>	88,
				'nama'	=> 'Unit Layanan Pengadaan'
			),
			array(
				'id'	=>	89,
				'nama'	=> 'Upt Teknologi Informasi Dan Komunikasi'
			),
			array(
				'id'	=>	90,
				'nama'	=> 'Unit Pelayanan Kelas'
			),
			array(
				'id'	=>	91,
				'nama'	=> 'Unit Poliklinik'
			),
			array(
				'id'	=>	94,
				'nama'	=> 'Hubungan Masyarakat'
			),
			array(
				'id'	=>	95,
				'nama'	=> 'Laboratorium Bahasa'
			),
			array(
				'id'	=>	96,
				'nama'	=> 'Laboratorium Teknik Informatika'
			),
			array(
				'id'	=>	97,
				'nama'	=> 'Laboratorium Teknik Sipil'
			),
			array(
				'id'	=>	98,
				'nama'	=> 'Laboratorium Teknik Mesin'
			),
			array(
				'id'	=>	99,
				'nama'	=> 'Laboratorium Teknik Pengolahan Hasil Ternak'
			),
			array(
				'id'	=>	100,
				'nama'	=> 'Laboratorium Agribisnis'
			),
			array(
				'id'	=>	101,
				'nama'	=> 'Laboratorium Manajemen Bisnis Pariwisata'
			),
			array(
				'id'	=>	102,
				'nama'	=> 'Satuan Pengawas Internal'
			),
			array(
				'id'	=>	103,
				'nama'	=> 'Unit Mata Kuliah Dasar Umum'
			),
			array(
				'id'	=>	104,
				'nama'	=> 'Satuan Pengamanan'
			),
			array(
				'id'	=>	106,
				'nama'	=> 'Unit Hotel Poliwangi'
			),
			array(
				'id'	=>	107,
				'nama'	=> 'Program Studi Teknik Manufaktur Kapal'
			),
			array(
				'id'	=>	110,
				'nama'	=> 'Pusat Perencanaan Dan Sistem Informasi'
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
        Schema::dropIfExists('unit');
    }
}
