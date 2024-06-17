<?php

namespace Modules\Monitoring\Database\Seeders;

use App\Models\Core\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MenuModulMonitoringTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Menu::where('modul', 'Monitoring')->delete();
        $menu = Menu::create([
            'modul' => 'Monitoring',
            'label' => 'Monitoring',
            'url' => '',
            'can' => serialize([]),
            'icon' => 'fas fa-money-bill',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['monitoring']),
        ]);

        if ($menu) {
            Menu::create([
                'modul' => 'Monitoring',
                'label' => 'Serapan Anggaran',
                'url' => 'monitoring',
                'can' => serialize([]),
                'icon' => 'fas fa-calculator',
                'urut' => 1,
                'parent_id' => $menu->id,
                'active' => serialize(['monitoring', 'monitoring*']),
            ]);

            Menu::create([
                'modul' => 'Monitoring',
                'label' => 'Perencanaan',
                'url' => 'monitoring/perencanaan',
                'can' => serialize([]),
                'icon' => 'fas fa-chart-line',
                'urut' => 2,
                'parent_id' => $menu->id,
                'active' => serialize(['monitoring/perencanaan', 'monitoring/perencanaan*']),
            ]);

            Menu::create([
                'modul' => 'Monitoring',
                'label' => 'Realisasi',
                'url' => 'monitoring/realisasi',
                'can' => serialize([]),
                'icon' => 'fas fa-plus',
                'urut' => 3,
                'parent_id' => $menu->id,
                'active' => serialize(['monitoring/realisasi', 'monitoring/realisasi*']),
            ]);

            Menu::create([
                'modul' => 'Monitoring',
                'label' => 'Laporan Bulanan',
                'url' => 'monitoring/laporan_bulanan',
                'can' => serialize(['admin', 'keuangan', 'pimpinan']),
                'icon' => 'fas fa-file-alt',
                'urut' => 4,
                'parent_id' => $menu->id,
                'active' => serialize(['monitoring/_bulanan', 'monitoring/laporan_bulanan*']),
            ]);
        }
    }
}
