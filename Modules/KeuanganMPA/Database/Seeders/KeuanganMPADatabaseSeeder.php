<?php

namespace Modules\KeuanganMPA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class KeuanganMPADatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(MenuModulKeuanganMPATableSeeder::class);
        // $this->call(PerencanaanModulKeuanganTableSeeder::class);
        // $this->call(SubPerencanaanModulKeuanganTableSeeder::class);
        // $this->call(RealisasiModulKeuanganMPATableSeeder::class);
        $this->call(UnitModulKeuanganmpaTableSeeder::class);
        $this->call(UserModulKeuanganMPATableSeeder::class);
        // $this->call(ArsipModulKeuanganMPATableSeeder::class);
    }
}
