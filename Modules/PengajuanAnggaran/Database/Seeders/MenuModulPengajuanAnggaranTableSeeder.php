<?php

namespace Modules\PengajuanAnggaran\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Core\Menu;

class MenuModulPengajuanAnggaranTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Menu::where('modul', 'Pengajuan Anggaran')->delete();
        $menu = Menu::create([
            'modul' => 'Pengajuan Anggaran',
            'label' => 'Pengajuan Anggaran',
            'url' => 'pengajuananggaran',
            'can' => serialize(['admin', 'pimpinan', 'pimpinan_unit']),
            'icon' => 'far fa-circle',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['pengajuananggaran']),
        ]);
        if ($menu) {
            Menu::create([
                'modul' => 'Pengajuan Anggaran',
                'label' => 'Pengajuan',
                'url' => 'pengajuananggaran/pengajuan',
                'can' => serialize(['admin', 'pimpinan', 'pimpinan_unit']),
                'icon' => 'far fa-circle',
                'urut' => 1,
                'parent_id' => $menu->id,
                'active' => serialize(['pengajuananggaran/pengajuan', 'pengajuananggaran/pengajuan*']),
            ]);
            Menu::create([
                'modul' => 'Pengajuan Anggaran',
                'label' => 'SBM',
                'url' => 'pengajuananggaran/sbm',
                'can' => serialize(['admin', 'pimpinan', 'pimpinan_unit']),
                'icon' => 'far fa-circle',
                'urut' => 1,
                'parent_id' => $menu->id,
                'active' => serialize(['pengajuananggaran/sbm', 'pengajuananggaran/sbm*']),
            ]);
            Menu::create([
                'modul' => 'Pengajuan Anggaran',
                'label' => 'IKU',
                'url' => 'pengajuananggaran/iku',
                'can' => serialize(['admin', 'pimpinan', 'pimpinan_unit']),
                'icon' => 'far fa-circle',
                'urut' => 1,
                'parent_id' => $menu->id,
                'active' => serialize(['pengajuananggaran/iku', 'pengajuananggaran/iku*']),
            ]);
        }
    }
}
