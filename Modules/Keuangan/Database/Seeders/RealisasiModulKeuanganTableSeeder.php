<?php

namespace Modules\Keuangan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RealisasiModulKeuanganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('realisasis')->insert([
            [
                'progres' => 'Progres 1',
                'realisasi' => 0,
                'laporan_keuangan' => 'laporan_keuangan_a1.pdf',
                'laporan_kegiatan' => 'laporan_kegiatan_a1.pdf',
                'ketercapian_output' => 'Tercapai',
                'tanggal_kontrak' => '2024-06-15',
                'tanggal_pembayaran' => '2024-07-15',
                'sub_perencanaan_id' => 1,
            ],
            [
                'progres' => 'Progres 2',
                'realisasi' => 0,
                'laporan_keuangan' => 'laporan_keuangan_a1.pdf',
                'laporan_kegiatan' => 'laporan_kegiatan_a1.pdf',
                'ketercapian_output' => 'Tercapai',
                'tanggal_kontrak' => '2024-06-15',
                'tanggal_pembayaran' => '2024-07-15',
                'sub_perencanaan_id' => 2,
            ],
            [
                'progres' => 'Progres 3',
                'realisasi' => 0,
                'laporan_keuangan' => 'laporan_keuangan_a1.pdf',
                'laporan_kegiatan' => 'laporan_kegiatan_a1.pdf',
                'ketercapian_output' => 'Tercapai',
                'tanggal_kontrak' => '2024-06-15',
                'tanggal_pembayaran' => '2024-07-15',
                'sub_perencanaan_id' => 3,
            ],
            [
                'progres' => 'Progres 4',
                'realisasi' => 0,
                'laporan_keuangan' => 'laporan_keuangan_a1.pdf',
                'laporan_kegiatan' => 'laporan_kegiatan_a1.pdf',
                'ketercapian_output' => 'Tercapai',
                'tanggal_kontrak' => '2024-06-15',
                'tanggal_pembayaran' => '2024-07-15',
                'sub_perencanaan_id' => 4,
            ],
            [
                'progres' => 'Progres 5',
                'realisasi' => 0,
                'laporan_keuangan' => 'laporan_keuangan_a1.pdf',
                'laporan_kegiatan' => 'laporan_kegiatan_a1.pdf',
                'ketercapian_output' => 'Tercapai',
                'tanggal_kontrak' => '2024-06-15',
                'tanggal_pembayaran' => '2024-07-15',
                'sub_perencanaan_id' => 5,
            ],
            [
                'progres' => 'Progres 6',
                'realisasi' => 0,
                'laporan_keuangan' => 'laporan_keuangan_a1.pdf',
                'laporan_kegiatan' => 'laporan_kegiatan_a1.pdf',
                'ketercapian_output' => 'Tercapai',
                'tanggal_kontrak' => '2024-06-15',
                'tanggal_pembayaran' => '2024-07-15',
                'sub_perencanaan_id' => 6,
            ],
            [
                'progres' => 'Progres 7',
                'realisasi' => 0,
                'laporan_keuangan' => 'laporan_keuangan_a1.pdf',
                'laporan_kegiatan' => 'laporan_kegiatan_a1.pdf',
                'ketercapian_output' => 'Tercapai',
                'tanggal_kontrak' => '2024-06-15',
                'tanggal_pembayaran' => '2024-07-15',
                'sub_perencanaan_id' => 7,
            ]
        ]);
    }
}
