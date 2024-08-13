<?php

namespace Modules\KeuanganMPA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UnitModulKeuanganmpaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('units')->insert([
            array(
				'id'	=>	2,
				'nama'	=> 'Wadir 1'
			),
            array(
				'id'	=>	3,
				'nama'	=> 'Wadir 2'
			),
            array(
				'id'	=>	4,
				'nama'	=> 'Wadir 3'
			),
            array(
				'id'	=>	72,
				'nama'	=> 'Jurusan Pertanian'
			),
            array(
				'id'	=>	73,
				'nama'	=> 'Jurusan Pariwisata'
			),
            array(
				'id'	=>	92,
				'nama'	=> 'Upt Bahasa'
			),
            array(
				'id'	=>	111,
				'nama'	=> 'Unit Kerjasama dan Urusan Internasional'
			),
            array(
				'id'	=>	112,
				'nama'	=> 'Poliwangi Press'
			),
            array(
				'id'	=>	113,
				'nama'	=> 'RBI'
			),
            array(
				'id'	=>	114,
				'nama'	=> 'Senat'
			),
            array(
				'id'	=>	115,
				'nama'	=> 'Pejabat Pembuat Komitmen'
			),
        ]);
    }
}
