<?php

namespace Modules\Monitoring\Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RealisasiModulMonitoringTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $faker = Factory::create('id_ID'); // Menggunakan lokal bahasa Indonesia

        $subPerencanaanIds = DB::table('sub_perencanaans')->pluck('id');

        // Loop through each sub_perencanaan ID and create three realisasis for each
        foreach ($subPerencanaanIds as $subPerencanaanId) {
            foreach (range(1, 2) as $index) {
                // Generate random dates for each month
                $startDate = Carbon::now()->subMonths(6);
                $tanggalKontrak = (clone $startDate)->addMonths($index)->startOfMonth();
                $tanggalPembayaran = (clone $tanggalKontrak)->addWeeks(2);

                DB::table('realisasis')->insert([
                    'progres' => $faker->randomElement(['0', '25', '50', '75', '100']),
                    'realisasi' => $faker->numberBetween(1000000, 10000000),
                    'laporan_keuangan' => $faker->word . '.pdf',
                    'laporan_kegiatan' => $faker->word . '.pdf',
                    'ketercapian_output' => $faker->sentence(3),
                    'tanggal_kontrak' => $tanggalKontrak,
                    'tanggal_pembayaran' => $tanggalPembayaran,
                    'sub_perencanaan_id' => $subPerencanaanId,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
