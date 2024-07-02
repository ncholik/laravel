<?php

namespace Modules\Keuangan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class KeuanganDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
        $this->call(UserModulKeuanganTableSeeder::class);
        $this->call(MenuModulKeuanganTableSeeder::class);
        $this->call(PegawaiModulKeuanganTableSeeder::class);
        $this->call(PerencanaanModulKeuanganTableSeeder::class);
        $this->call(SubPerencanaanModulKeuanganTableSeeder::class);
        $this->call(RealisasiModulKeuanganTableSeeder::class);
    }
}
