<?php

namespace Modules\Keuangan\Database\Seeders;

use App\Models\Core\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserModulKeuanganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        \Artisan::call('permission:create-permission-routes-sync');

        $perencanaan = User::create([
            'name' => 'Perencanaan',
            'email' => 'perencanaan@gmail.com',
            'username' => 'perencanaan',
            'password' => Hash::make('12345678'),
            'unit' => 72,
            'staff' => 22,
            'status' => 2
        ]);

        $keuangan = User::create([
            'name' => 'Keuangan',
            'email' => 'keuangan@gmail.com',
            'username' => 'keuangan',
            'password' => Hash::make('12345678'),
            'unit' => 72,
            'staff' => 22,
            'status' => 2
        ]);

        $penanggung = User::create([
            'name' => 'Penanggung Jawab Unit',
            'email' => 'penanggung@gmail.com',
            'username' => 'penanggung',
            'password' => Hash::make('12345678'),
            'unit' => 72,
            'staff' => 22,
            'status' => 2
        ]);

        $pimpinan = User::create([
            'name' => 'Pimpinan',
            'email' => 'pimpinan@gmail.com',
            'username' => 'pimpinan',
            'password' => Hash::make('12345678'),
            'unit' => 72,
            'staff' => 22,
            'status' => 2
        ]);

        $rolePerencanaan = Role::create(['name' => 'perencanaan']);
        $roleKeuangan = Role::create(['name' => 'keuangan']);
        $rolePenanggung = Role::create(['name' => 'penanggung']);
        $rolePimpinan = Role::create(['name' => 'pimpinan']);

        $permissions = Permission::where('name', 'adminlte.darkmode.toggle')
            ->orWhere('name', 'logout.perform')
            ->orWhere('name', 'home.index')
            ->orWhere('name', 'login.show')
            ->orWhere('name', 'perencanaan.index')
            ->orWhere('name', 'perencanaan.show')
            ->orWhere('name', 'perencanaan.sub_index')
            ->orWhere('name', 'realisasi.index')
            ->orWhere('name', 'laporan.index')
            ->pluck('id', 'id')
            ->all();

        $perencanaan->assignRole([$rolePerencanaan->id]);
        $keuangan->assignRole([$roleKeuangan->id]);
        $penanggung->assignRole([$rolePenanggung->id]);
        $pimpinan->assignRole([$rolePimpinan->id]);

        $rolePerencanaan->syncPermissions($permissions);
        $roleKeuangan->syncPermissions($permissions);
        $rolePenanggung->syncPermissions($permissions);
        $rolePimpinan->syncPermissions($permissions);
    }
}
