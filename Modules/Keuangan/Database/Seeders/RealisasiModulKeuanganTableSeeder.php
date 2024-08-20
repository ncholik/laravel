<?php

namespace Modules\Keuangan\Database\Seeders;

use Carbon\Carbon;
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
            
            // mesin
            [
                'progres' => 'Progres 1',
                'realisasi' => 799200,
                'laporan_keuangan' => 'laporan_keuangan_a1.pdf',
                'laporan_kegiatan' => 'laporan_kegiatan_a1.pdf',
                'ketercapaian_output' => 'Tercapai',
                'tanggal_kontrak' => '2024-04-15',
                'tanggal_pembayaran' => '2024-04-15',
                'sub_perencanaan_id' => 9,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'progres' => 'Progres 2',
                'realisasi' => 3595400,
                'laporan_keuangan' => 'laporan_keuangan_a1.pdf',
                'laporan_kegiatan' => 'laporan_kegiatan_a1.pdf',
                'ketercapaian_output' => 'Tercapai',
                'tanggal_kontrak' => '2024-06-15',
                'tanggal_pembayaran' => '2024-06-15',
                'sub_perencanaan_id' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'progres' => 'Progres 1',
                'realisasi' => 10000000,
                'laporan_keuangan' => 'laporan_keuangan_a1.pdf',
                'laporan_kegiatan' => 'laporan_kegiatan_a1.pdf',
                'ketercapaian_output' => 'Tercapai',
                'tanggal_kontrak' => '2024-04-15',
                'tanggal_pembayaran' => '2024-04-15',
                'sub_perencanaan_id' => 14,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'progres' => 'Progres 1',
                'realisasi' => 7000000,
                'laporan_keuangan' => 'laporan_keuangan_a1.pdf',
                'laporan_kegiatan' => 'laporan_kegiatan_a1.pdf',
                'ketercapaian_output' => 'Tercapai',
                'tanggal_kontrak' => '2024-02-15',
                'tanggal_pembayaran' => '2024-02-15',
                'sub_perencanaan_id' => 16,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
