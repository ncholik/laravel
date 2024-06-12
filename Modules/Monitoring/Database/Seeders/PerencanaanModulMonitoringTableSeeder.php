<?php

namespace Modules\Monitoring\Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Monitoring\Entities\Perencanaan;

class PerencanaanModulMonitoringTableSeeder extends Seeder
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

        $unitIds = [
            13, 14, 16, 18, 19, 20, 74,
            75, 76, 77, 78, 79, 96, 97,
            98, 99, 100, 101, 102, 103,
            104, 106, 107, 110
        ];

        // Loop through each unit ID and create two perencanaans for each
        foreach ($unitIds as $unitId) {
            foreach (range(1, 3) as $index) {
                DB::table('perencanaans')->insert([
                    'nama' => $faker->sentence(3),
                    'kode' => $faker->bothify('??-######'),
                    'sumber' => $faker->randomElement(['PNP', 'RM', 'Hibah']),
                    'revisi' => $faker->numberBetween(0, 2),
                    'unit_id' => $unitId, // Assign the current unit ID
                    'created_at' => $faker->dateTimeBetween('-5 month', 'now'),
                    'updated_at' => $faker->dateTimeBetween('-5 month', 'now')
                ]);
            }
        }
    }
}
