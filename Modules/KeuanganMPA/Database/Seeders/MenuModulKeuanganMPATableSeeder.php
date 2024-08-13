<?php

namespace Modules\KeuanganMPA\Database\Seeders;

use App\Models\Core\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MenuModulKeuanganMPATableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::where('modul', 'KeuanganMPA')->delete();
        $menu = Menu::create([
            'modul' => 'KeuanganMPA',
            'label' => 'KeuanganMPA',
            'url' => '',
            'can' => serialize(['admin', 'dosen', 'pegawai', 'direktur', 'wadir1', 'wadir2', 'wadir3', 'kaprodi', 'kajur', 'p2m', 'kaunit']),
            'icon' => 'fas fa-money-bill',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['keuanganmpa']),
        ]);

        if ($menu) {
            Menu::create([
                'modul' => 'KeuanganMPA',
                'label' => 'Dashboard Bulanan',
                'url' => 'keuanganmpa/dashboard-bulanan',
                'can' => serialize(['admin', 'dosen', 'pegawai', 'direktur', 'wadir1', 'wadir2', 'wadir3', 'kaprodi', 'kajur', 'p2m', 'kaunit']),
                'icon' => 'fas fa-tachometer-alt',
                'urut' => 1,
                'parent_id' => $menu->id,
                'active' => serialize(['keuanganmpa/dashboard-bulanan', 'keuanganmpa/dashboard-bulanan*']),
            ]);

            Menu::create([
                'modul' => 'KeuanganMPA',
                'label' => 'Dashboard Triwulan',
                'url' => 'keuanganmpa/dashboard-triwulan',
                'can' => serialize(['admin', 'dosen', 'pegawai', 'direktur', 'wadir1', 'wadir2', 'wadir3', 'kaprodi', 'kajur', 'p2m', 'kaunit']),
                'icon' => 'fas fa-tachometer-alt',
                'urut' => 2,
                'parent_id' => $menu->id,
                'active' => serialize(['keuanganmpa/dashboard-triwulan', 'keuanganmpa/dashboard-triwulan*']),
            ]);

            Menu::create([
                'modul' => 'KeuanganMPA',
                'label' => 'Realisasi',
                'url' => 'keuanganmpa/realisasi',
                'can' => serialize(['admin', 'dosen', 'pegawai', 'direktur', 'wadir1', 'wadir2', 'wadir3', 'kaprodi', 'kajur', 'p2m', 'kaunit']),
                'icon' => 'fas fa-plus',
                'urut' => 4,
                'parent_id' => $menu->id,
                'active' => serialize(['keuanganmpa/realisasi', 'keuanganmpa/realisasi*']),
            ]);

            Menu::create([
                'modul' => 'KeuanganMPA',
                'label' => 'Laporan',
                'url' => 'keuanganmpa/laporan',
                'can' => serialize(['admin', 'direktur', 'wadir1', 'wadir2', 'wadir3', 'kaprodi', 'kajur', 'p2m', 'kaunit']),
                'icon' => 'fas fa-file-alt',
                'urut' => 5,
                'parent_id' => $menu->id,
                'active' => serialize(['keuanganmpa/laporan', 'keuanganmpa/laporan*']),
            ]);
        }
    }
}
