<?php

namespace Modules\Kepegawaian\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Core\Menu;

class MenuModulKepegawaianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Menu::where('modul','Kepegawaian')->delete();
        $menu = Menu::create([
            'modul' => 'Kepegawaian',
            'label' => 'Kepegawaian',
            'url' => '',
            'can' => serialize(['admin']),
            'icon' => 'far fa-circle',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['kepegawaian']),
        ]);
        if($menu){
            Menu::create([
                'modul' => 'Kepegawaian',
                'label' => 'Master Pegawai',
                'url' => 'kepegawaian/pegawai',
                'can' => serialize(['admin']),
                'icon' => 'far fa-circle',
                'urut' => 1,
                'parent_id' => $menu->id,
                'active' => serialize(['kepegawaian/pegawai','kepegawaian/pegawai*']),
            ]);
        }
    }
}
