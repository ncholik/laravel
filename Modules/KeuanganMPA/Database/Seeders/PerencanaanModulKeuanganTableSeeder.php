<?php

namespace Modules\KeuanganMPA\Database\Seeders;

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
            // bisnis dan informatika
            [
                'nama' => ' ',
                'kode' => '000031',
                'sumber' => 'BOPTN',
                'pagu' => '40306000',
                'revisi' => 1,
            ],
            [
                'nama' => ' ',
                'kode' => '000235',
                'sumber' => 'PNBP',
                'pagu' => '27088000',
                'revisi' => 1,
            ],
            [
                'nama' => ' ',
                'kode' => '000236',
                'sumber' => 'PNBP',
                'pagu' => '27087000',
                'revisi' => 1,
            ],
            [
                'nama' => ' ',
                'kode' => '000237',
                'sumber' => 'PNBP',
                'pagu' => '27088000',
                'revisi' => 1,
            ],
            [
                'nama' => ' ',
                'kode' => '000238',
                'sumber' => 'PNBP',
                'pagu' => '18207000',
                'revisi' => 1,
            ],
            [
                'nama' => ' ',
                'kode' => '000239',
                'sumber' => 'PNBP',
                'pagu' => '20000000',
                'revisi' => 1,
            ],
            [
                'nama' => ' ',
                'kode' => '000240',
                'sumber' => 'PNBP',
                'pagu' => '27271000',
                'revisi' => 1,
            ],

            // teknik mesin
            [
                'nama' => ' ',
                'kode' => '000028',
                'sumber' => 'BOPTN',
                'pagu' => '20000000',
                'revisi' => 1,
            ],
            [
                'nama' => ' ',
                'kode' => '000036',
                'sumber' => 'BOPTN',
                'pagu' => '150000000',
                'revisi' => 1,
            ],
            [
                'nama' => ' ',
                'kode' => '000223',
                'sumber' => 'PNBP',
                'pagu' => '10000000',
                'revisi' => 1,
            ],
            [
                'nama' => ' ',
                'kode' => '000224',
                'sumber' => 'PNBP',
                'pagu' => '10000000',
                'revisi' => 1,
            ],
            [
                'nama' => ' ',
                'kode' => '000225',
                'sumber' => 'PNBP',
                'pagu' => '64100000',
                'revisi' => 1,
            ],
        ]);
    }
}
