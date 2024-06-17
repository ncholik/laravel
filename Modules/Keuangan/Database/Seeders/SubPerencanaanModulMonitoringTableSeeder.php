<?php

namespace Modules\Monitoring\Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Monitoring\Entities\SubPerencanaan;

class SubPerencanaanModulMonitoringTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $faker = Factory::create('id_ID');

        $perencanaanIds = DB::table('perencanaans')->pluck('id');

        // Loop through each perencanaan ID and create five sub_perencanaans for each
        foreach ($perencanaanIds as $perencanaanId) {
            foreach (range(1, 12) as $index) {
                // Generate random dates for each month
                $startDate = Carbon::now()->subMonths(5);
                $rencanaMulai = (clone $startDate)->addMonths($index)->startOfMonth();
                $rencanaBayar = (clone $rencanaMulai)->addWeeks(2);

                DB::table('sub_perencanaans')->insert([
                    'kegiatan' => $faker->sentence(3),
                    'metode_pengadaan' => $faker->randomElement([
                        'Swakelola',
                        'Pengadaan Langsung',
                        'E-purchasing',
                        'Tender',
                        'Seleksi',
                        'Penunjukan Langsung'
                    ]),
                    'satuan' => $faker->word,
                    'volume' => $faker->numberBetween(1, 100),
                    'harga_satuan' => $faker->numberBetween(100000, 1000000),
                    'output' => $faker->word,
                    'rencana_mulai' => $rencanaMulai,
                    'rencana_bayar' => $rencanaBayar,
                    'file_hps' => $faker->word . '.pdf',
                    'file_kak' => $faker->word . '.pdf',
                    'perencanaan_id' => $perencanaanId,
                    'pic_id' => $faker->numberBetween(1, 20),
                    'ppk_id' => $faker->numberBetween(1, 20),
                    'pp_id' => $faker->optional()->numberBetween(1, 20),
                    'jenis' => $faker->randomElement([
                        'Barang',
                        'Jasa Konsultansi',
                        'Operasional',
                        'Pekerjaan Konstruksi'
                    ]),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
