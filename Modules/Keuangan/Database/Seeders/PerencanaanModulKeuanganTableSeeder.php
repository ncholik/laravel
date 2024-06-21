<?php

namespace Modules\Keuangan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PerencanaanModulKeuanganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('perencanaans')->insert([
            [
                'nama' => 'Program 1',
                'kode' => '000031',
                'sumber' => 'RM',
                'revisi' => 1,
                'unit_id' => 74
            ],
            [
                'nama' => 'Program 2',
                'kode' => '000235',
                'sumber' => 'PNP',
                'revisi' => 1,
                'unit_id' => 74
            ],
            [
                'nama' => 'Program 3',
                'kode' => '000236',
                'sumber' => 'PNP',
                'revisi' => 1,
                'unit_id' => 74
            ],
            [
                'nama' => 'Program 4',
                'kode' => '000237',
                'sumber' => 'PNP',
                'revisi' => 1,
                'unit_id' => 74
            ],
            [
                'nama' => 'Program 5',
                'kode' => '000238',
                'sumber' => 'PNP',
                'revisi' => 1,
                'unit_id' => 74
            ],
            [
                'nama' => 'Program 6',
                'kode' => '000239',
                'sumber' => 'PNP',
                'revisi' => 1,
                'unit_id' => 74
            ],
            [
                'nama' => 'Program 7',
                'kode' => '000240',
                'sumber' => 'PNP',
                'revisi' => 1,
                'unit_id' => 74
            ],
        ]);
    }
}
