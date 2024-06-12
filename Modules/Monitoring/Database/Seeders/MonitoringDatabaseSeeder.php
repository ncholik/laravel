<?php

namespace Modules\Monitoring\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MonitoringDatabaseSeeder extends Seeder
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

        $this->call(MenuModulMonitoringTableSeeder::class);
        $this->call(PegawaiTableSeeder::class);
        $this->call(UserModulMonitoringTableSeeder::class);
        $this->call(PerencanaanModulMonitoringTableSeeder::class);
        $this->call(SubPerencanaanModulMonitoringTableSeeder::class);
        $this->call(RealisasiModulMonitoringTableSeeder::class);
    }
}
