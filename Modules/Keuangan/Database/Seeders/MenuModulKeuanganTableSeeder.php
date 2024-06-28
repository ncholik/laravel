<?php

namespace Modules\Keuangan\Database\Seeders;

use App\Models\Core\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MenuModulKeuanganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Menu::where('modul', 'Keuangan')->delete();
        $menu = Menu::create([
            'modul' => 'Keuangan',
            'label' => 'Monitoring',
            'url' => '',
            'can' => serialize([]),
            'icon' => 'fas fa-money-bill',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['keuangan']),
        ]);

        if ($menu) {
            Menu::create([
                'modul' => 'Keuangan',
                'label' => 'Serapan Anggaran',
                'url' => 'keuangan',
                'can' => serialize([]),
                'icon' => 'fas fa-calculator',
                'urut' => 1,
                'parent_id' => $menu->id,
                'active' => serialize(['keuangan', 'keuangan*']),
            ]);

            Menu::create([
                'modul' => 'Keuangan',
                'label' => 'Perencanaan',
                'url' => 'keuangan/perencanaan',
                'can' => serialize([]),
                'icon' => 'fas fa-chart-line',
                'urut' => 2,
                'parent_id' => $menu->id,
                'active' => serialize(['keuangan/perencanaan', 'keuangan/perencanaan*']),
            ]);

            Menu::create([
                'modul' => 'Keuangan',
                'label' => 'Realisasi',
                'url' => 'keuangan/realisasi',
                'can' => serialize([]),
                'icon' => 'fas fa-plus',
                'urut' => 3,
                'parent_id' => $menu->id,
                'active' => serialize(['keuangan/realisasi', 'keuangan/realisasi*']),
            ]);

            Menu::create([
                'modul' => 'Keuangan',
                'label' => 'Laporan',
                'url' => 'keuangan/laporan',
                'can' => serialize(['admin', 'keuangan', 'pimpinan']),
                'icon' => 'fas fa-file-alt',
                'urut' => 4,
                'parent_id' => $menu->id,
                'active' => serialize(['keuangan/laporan', 'keuangan/laporan*']),
            ]);
        }
    }
}
