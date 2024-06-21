<?php

namespace Modules\Monitoring\Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PegawaiTableSeeder extends Seeder
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
        foreach (range(1, 20) as $index) {
            DB::table('pegawais')->insert([
                'nip' => $faker->optional()->numerify('###############'),
                'noid' => $faker->optional()->numerify('###############'),
                'nama' => $faker->name,
                'id_staff' => $faker->optional()->randomDigitNotNull,
                'id_jurusan' => $faker->optional()->randomDigitNotNull,
                'id_prodi' => $faker->optional()->randomDigitNotNull,
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'agama' => $faker->optional()->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu']),
                'no_tlp' => $faker->optional()->phoneNumber,
                'tgl_lahir' => $faker->optional()->date,
                'gol_darah' => $faker->optional()->randomElement(['A', 'B', 'AB', 'O']),
                'gelar_dpn' => $faker->optional()->randomElement(['Dr.', 'Ir.', 'Prof.', '']),
                'gelar_blk' => $faker->optional()->randomElement(['S.T.', 'M.T.', 'Ph.D.', '']),
                'status_kawin' => $faker->optional()->randomElement(['TK', 'K']),
                'kelurahan' => $faker->optional()->citySuffix,
                'kecamatan' => $faker->optional()->citySuffix,
                'kota' => $faker->optional()->city,
                'provinsi' => $faker->optional()->state,

                'askes' => $faker->optional()->numerify('###############'),
                'kode_dosen' => $faker->optional()->numerify('##########'),
                'npwp' => $faker->optional()->numerify('###############'),
                'nidn' => $faker->optional()->numerify('###############'),

                'username' => $faker->optional()->userName,
                'id_dosen_feeder' => $faker->optional()->uuid,
                'id_status_dosen_feeder' => $faker->optional()->uuid,
                'id_reg_dosen_feeder' => $faker->optional()->uuid,

                'status_karyawan' => $faker->optional()->randomElement(['1', '0']),

                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}