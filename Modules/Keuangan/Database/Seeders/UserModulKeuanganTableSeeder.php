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

        $keuangan = User::create([
            'name' => 'Keuangan',
            'email' => 'keuangan@gmail.com',
            'username' => 'yuli',
            'password' => Hash::make('12345678'),
            'unit' => 18,
            'staff' => 18,
            'status' => 2
        ]);

        $penanggung = User::create([
            'name' => 'Penanggung Jawab Unit',
            'email' => 'penanggung@gmail.com',
            'username' => 'dianni yusuf',
            'password' => Hash::make('12345678'),
            'unit' => 72,
            'staff' => 22,
            'status' => 2
        ]);

        $pimpinan = User::create([
            'name' => 'Pimpinan',
            'email' => 'pimpinan@gmail.com',
            'username' => 'devit suwardiyanto',
            'password' => Hash::make('12345678'),
            'unit' => 13,
            'staff' => 21,
            'status' => 2
        ]);

        $roleKeuangan = Role::create(['name' => 'keuangan']);
        $rolePenanggung = Role::create(['name' => 'penanggung']);
        $rolePimpinan = Role::create(['name' => 'pimpinan']);
        $roleTerdaftar = Role::firstOrCreate(['name' => 'terdaftar']);

        $permissions_keuangan = Permission::where('name', 'adminlte.darkmode.toggle')
            ->orWhere('name', 'logout.perform')
            ->orWhere('name', 'home.index')
            ->orWhere('name', 'login.show')
            ->orWhere('name', 'dashboard')
            ->orWhere('name', 'dashboard_triwulan')
            ->orWhere('name', 'perencanaan.sub_index')
            ->orWhere('name', 'perencanaan.show')
            ->orWhere('name', 'realisasi.index')
            ->orWhere('name', 'realisasi.show')
            ->orWhere('name', 'laporan.index')
            ->orWhere('name', 'laporan.generate')
            ->orWhere('name', 'laporan.show_pdf')
            ->orWhere('name', 'laporan.reset')
            ->pluck('id', 'id')
            ->all();

        $permissions_penanggung = Permission::where('name', 'adminlte.darkmode.toggle')
            ->orWhere('name', 'logout.perform')
            ->orWhere('name', 'home.index')
            ->orWhere('name', 'login.show')
            ->orWhere('name', 'dashboard')
            ->orWhere('name', 'dashboard_triwulan')
            ->orWhere('name', 'perencanaan.sub_index')
            ->orWhere('name', 'perencanaan.show')
            ->orWhere('name', 'realisasi.index')
            ->orWhere('name', 'realisasi.show')
            ->orWhere('name', 'laporan.create')
            ->orWhere('name', 'laporan.store')
            ->orWhere('name', 'laporan.edit')
            ->orWhere('name', 'laporan.update')
            ->pluck('id', 'id')
            ->all();

        $permissions_pimpinan = Permission::where('name', 'adminlte.darkmode.toggle')
            ->orWhere('name', 'logout.perform')
            ->orWhere('name', 'home.index')
            ->orWhere('name', 'login.show')
            ->orWhere('name', 'dashboard')
            ->orWhere('name', 'dashboard_triwulan')
            ->orWhere('name', 'perencanaan.sub_index')
            ->orWhere('name', 'perencanaan.show')
            ->orWhere('name', 'realisasi.index')
            ->orWhere('name', 'realisasi.show')
            ->orWhere('name', 'laporan.index')
            ->orWhere('name', 'laporan.generate')
            ->orWhere('name', 'laporan.show_pdf')
            ->orWhere('name', 'laporan.reset')
            ->pluck('id', 'id')
            ->all();

        $permissions_terdaftar = Permission::where('name', 'adminlte.darkmode.toggle')
            ->orWhere('name', 'logout.perform')
            ->orWhere('name', 'home.index')
            ->orWhere('name', 'login.show')
            ->orWhere('name', 'dashboard')
            ->orWhere('name', 'dashboard_triwulan')
            ->orWhere('name', 'perencanaan.sub_index')
            ->orWhere('name', 'perencanaan.show')
            ->orWhere('name', 'realisasi.index')
            ->orWhere('name', 'realisasi.show')
            ->pluck('id', 'id')
            ->all();

        $keuangan->assignRole([$roleKeuangan->id]);
        $penanggung->assignRole([$rolePenanggung->id]);
        $pimpinan->assignRole([$rolePimpinan->id]);

        $roleKeuangan->syncPermissions($permissions_keuangan);
        $rolePenanggung->syncPermissions($permissions_penanggung);
        $rolePimpinan->syncPermissions($permissions_pimpinan);
        $roleTerdaftar->syncPermissions($permissions_terdaftar);
    }
}
