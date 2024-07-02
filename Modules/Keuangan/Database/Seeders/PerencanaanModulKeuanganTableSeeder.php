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
            // bisnis dan informatika
            [
                'nama' => 'Pengadaan Bahan Praktikum - Jurusan Bisnis dan Informatika',
                'kode' => '000031',
                'sumber' => 'RM',
                'anggaran' => '40306000',
                'revisi' => 1,
                'unit_id' => 74
            ],
            [
                'nama' => 'Workshop Big Data Analysis using Python (Internal)',
                'kode' => '000235',
                'sumber' => 'PNP',
                'anggaran' => '27088000',
                'revisi' => 1,
                'unit_id' => 74
            ],
            [
                'nama' => 'Workshop Introduction to DevOps with Kubernetes',
                'kode' => '000236',
                'sumber' => 'PNP',
                'anggaran' => '27087000',
                'revisi' => 1,
                'unit_id' => 74
            ],
            [
                'nama' => 'Workshop System Analyst and Design',
                'kode' => '000237',
                'sumber' => 'PNP',
                'anggaran' => '27088000',
                'revisi' => 1,
                'unit_id' => 74
            ],
            [
                'nama' => 'Workshop Software Quality Assurance',
                'kode' => '000238',
                'sumber' => 'PNP',
                'anggaran' => '18207000',
                'revisi' => 1,
                'unit_id' => 74
            ],
            [
                'nama' => 'Sewa lisensi software',
                'kode' => '000239',
                'sumber' => 'PNP',
                'anggaran' => '20000000',
                'revisi' => 1,
                'unit_id' => 74
            ],
            [
                'nama' => 'Perbaikan Peralatan Laboratorium',
                'kode' => '000240',
                'sumber' => 'PNP',
                'anggaran' => '27271000',
                'revisi' => 1,
                'unit_id' => 74
            ],

            // teknik mesin
            [
                'nama' => 'Pengadaan Bahan Praktikum Bahan Segar - Jurusan Teknik Mesin',
                'kode' => '000028',
                'sumber' => 'PNP',
                'anggaran' => '20000000',
                'revisi' => 1,
                'unit_id' => 75
            ],
            [
                'nama' => 'Pengadaan Bahan Praktikum -Jurusan Teknik Mesin',
                'kode' => '000036',
                'sumber' => 'PNP',
                'anggaran' => '150000000',
                'revisi' => 1,
                'unit_id' => 75
            ],
            [
                'nama' => 'Keikutsertaan Lomba Nasional KKCTBN 2024',
                'kode' => '000223',
                'sumber' => 'PNP',
                'anggaran' => '10000000',
                'revisi' => 1,
                'unit_id' => 75
            ],
            [
                'nama' => 'Keikutsertaan Lomba Nasional KMHE, KRI, KMLI 2024',
                'kode' => '000224',
                'sumber' => 'PNP',
                'anggaran' => '10000000',
                'revisi' => 1,
                'unit_id' => 75
            ],
            [
                'nama' => 'Perpanjangan lisensi 3 (tiga) software lab. Komputer',
                'kode' => '000225',
                'sumber' => 'PNP',
                'anggaran' => '64100000',
                'revisi' => 1,
                'unit_id' => 75
            ],
        ]);
    }
}
