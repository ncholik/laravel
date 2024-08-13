<?php

namespace Modules\KeuanganMPA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\KeuanganMPA\Entities\Perencanaan;
use Modules\KeuanganMPA\Entities\Realisasi;

class ArsipModulKeuanganMPATableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $tahun = 2024;

        // Fetch all perencanaan and realisasi records
        $perencanaans = Perencanaan::all();
        $realisasis = Realisasi::all();

        // Insert data into arsip table
        foreach ($realisasis as $realisasi) {
            DB::table('arsip')->insert([
                'perencanaan_id' => $realisasi->perencanaan_id,
                'realisasi_id' => $realisasi->id,
                'tahun' => $tahun,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
