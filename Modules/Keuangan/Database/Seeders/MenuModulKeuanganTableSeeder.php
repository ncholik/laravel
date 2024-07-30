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
            'can' => serialize(['admin', 'keuangan', 'pimpinan', 'terdaftar', 'penanggung']),
            'icon' => 'fas fa-money-bill',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['keuangan']),
        ]);

        if ($menu) {
            Menu::create([
                'modul' => 'Keuangan',
                'label' => 'Dashboard Bulanan',
                'url' => 'keuangan/dashboard-bulanan',
                'can' => serialize(['admin', 'keuangan', 'pimpinan', 'terdaftar', 'penanggung']),
                'icon' => 'fas fa-tachometer-alt',
                'urut' => 1,
                'parent_id' => $menu->id,
                'active' => serialize(['keuangan/dashboard-bulanan', 'keuangan/dashboard-bulanan*']),
            ]);

            Menu::create([
                'modul' => 'Keuangan',
                'label' => 'Dashboard Triwulan',
                'url' => 'keuangan/dashboard-triwulan',
                'can' => serialize(['admin', 'keuangan', 'pimpinan', 'terdaftar', 'penanggung']),
                'icon' => 'fas fa-tachometer-alt',
                'urut' => 2,
                'parent_id' => $menu->id,
                'active' => serialize(['keuangan/dashboard-triwulan', 'keuangan/dashboard-triwulan*']),
            ]);

            Menu::create([
                'modul' => 'Keuangan',
                'label' => 'Realisasi',
                'url' => 'keuangan/realisasi',
                'can' => serialize(['admin', 'keuangan', 'pimpinan', 'terdaftar', 'penanggung']),
                'icon' => 'fas fa-plus',
                'urut' => 4,
                'parent_id' => $menu->id,
                'active' => serialize(['keuangan/realisasi', 'keuangan/realisasi*']),
            ]);

            Menu::create([
                'modul' => 'Keuangan',
                'label' => 'Laporan',
                'url' => 'keuangan/laporan',
                'can' => serialize(['admin', 'keuangan', 'pimpinan']),
                'icon' => 'fas fa-file-alt',
                'urut' => 5,
                'parent_id' => $menu->id,
                'active' => serialize(['keuangan/laporan', 'keuangan/laporan*']),
            ]);
        }
    }
}
