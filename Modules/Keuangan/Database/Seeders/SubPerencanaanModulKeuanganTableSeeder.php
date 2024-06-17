<?php

namespace Modules\Keuangan\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SubPerencanaanModulKeuanganTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        DB::table('sub_perencanaans')->insert([
            [
                'kegiatan' => 'Pengadaan Bahan Praktikum - Jurusan Bisnis dan Informatika',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' => 40306000,
                'output' => 'Output 1',
                'rencana_mulai' => '2024-06-01',
                'rencana_bayar' => '2024-07-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 1,
                'pic_id' => 1,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],
            [
                'kegiatan' => 'Workshop Big Data Analysis using Python (Internal)',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' => 27088000,
                'output' => 'Output 2',
                'rencana_mulai' => '2024-06-01',
                'rencana_bayar' => '2024-07-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 2,
                'pic_id' => 1,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],
            [
                'kegiatan' => 'Workshop Introduction to DevOps with Kubernetes',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' => 27087000,
                'output' => 'Output 3',
                'rencana_mulai' => '2024-06-01',
                'rencana_bayar' => '2024-07-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 3,
                'pic_id' => 1,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],
            [
                'kegiatan' => 'Workshop System Analyst and Design',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' => 27088000,
                'output' => 'Output 4',
                'rencana_mulai' => '2024-06-01',
                'rencana_bayar' => '2024-07-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 4,
                'pic_id' => 1,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],
            [
                'kegiatan' => 'Workshop Software Quality Assurance',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' => 18207000,
                'output' => 'Output 5',
                'rencana_mulai' => '2024-06-01',
                'rencana_bayar' => '2024-07-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 5,
                'pic_id' => 1,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],
            [
                'kegiatan' => 'Sewa licensi software',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' => 20000000,
                'output' => 'Output 6',
                'rencana_mulai' => '2024-06-01',
                'rencana_bayar' => '2024-07-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 6,
                'pic_id' => 1,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],
            [
                'kegiatan' => 'Perbaikan Peralatan Laboratorium',
                'metode_pengadaan' => 'Swakelola',
                'satuan' => 'Unit',
                'volume' => 1,
                'harga_satuan' =>  27271000,
                'output' => 'Output 7',
                'rencana_mulai' => '2024-06-01',
                'rencana_bayar' => '2024-07-01',
                'file_hps' => 'file_hps_a1.pdf',
                'file_kak' => 'file_kak_a1.pdf',
                'perencanaan_id' => 7,
                'pic_id' => 1,
                'ppk_id' => 1,
                'jenis' => 'Barang'
            ],
        ]);
    }
}
