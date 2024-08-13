<?php

namespace Modules\KeuanganMPA\Database\Seeders;

use App\Models\Core\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserModulKeuanganMPATableSeeder extends Seeder
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

        $dosen = User::create([
            'name' => 'dosen',
            'email' => 'dosen@gmail.com',
            'username' => 'dosen',
            'password' => Hash::make('12345678'),
            'unit' => 72,
            'staff' => 22,
            'role_aktif' => 'dosen',
            'status' => 2
        ]);

        $pegawai = User::create([
            'name' => 'pegawai',
            'email' => 'pegawai@gmail.com',
            'username' => 'pegawai',
            'password' => Hash::make('12345678'),
            'unit' => 13,
            'staff' => 21,
            'role_aktif' => 'pegawai',
            'status' => 2
        ]);

        $direktur = User::create([
            'name' => 'direktur',
            'email' => 'direktur@gmail.com',
            'username' => 'direktur',
            'password' => Hash::make('12345678'),
            'unit' => 13,
            'staff' => 21,
            'role_aktif' => 'direktur',
            'status' => 2
        ]);

        $wadir1 = User::create([
            'name' => 'wadir1',
            'email' => 'wadir1@gmail.com',
            'username' => 'wadir1',
            'password' => Hash::make('12345678'),
            'unit' => 13,
            'staff' => 21,
            'role_aktif' => 'wadir1',
            'status' => 2
        ]);

        $wadir2 = User::create([
            'name' => 'wadir2',
            'email' => 'wadir2@gmail.com',
            'username' => 'devit suwardiyanto',
            'password' => Hash::make('12345678'),
            'unit' => 13,
            'staff' => 21,
            'role_aktif' => 'wadir2',
            'status' => 2
        ]);

        $wadir3 = User::create([
            'name' => 'wadir3',
            'email' => 'wadir3@gmail.com',
            'username' => 'wadir3',
            'password' => Hash::make('12345678'),
            'unit' => 13,
            'staff' => 21,
            'role_aktif' => 'wadir3',
            'status' => 2
        ]);

        $kaprodi = User::create([
            'name' => 'kaprodi',
            'email' => 'kaprodi@gmail.com',
            'username' => 'kaprodi',
            'password' => Hash::make('12345678'),
            'unit' => 13,
            'staff' => 21,
            'role_aktif' => 'kaprodi',
            'status' => 2
        ]);

        $kajur = User::create([
            'name' => 'kajur',
            'email' => 'kajur@gmail.com',
            'username' => 'kajur',
            'password' => Hash::make('12345678'),
            'unit' => 13,
            'staff' => 21,
            'role_aktif' => 'kajur',
            'status' => 2
        ]);

        $p2m = User::create([
            'name' => 'p2m',
            'email' => 'p2m@gmail.com',
            'username' => 'p2m',
            'password' => Hash::make('12345678'),
            'unit' => 13,
            'staff' => 21,
            'role_aktif' => 'p2m',
            'status' => 2
        ]);

        $kaunit = User::create([
            'name' => 'kaunit',
            'email' => 'kaunit@gmail.com',
            'username' => 'kaunit',
            'password' => Hash::make('12345678'),
            'unit' => 18,
            'staff' => 18,
            'role_aktif' => 'kaunit',
            'status' => 2
        ]);

        $roleMahasiswa = Role::create(['name' => 'mahasiswa']);
        $roleDosen = Role::create(['name' => 'dosen']);
        $rolePegawai = Role::create(['name' => 'pegawai']);
        $roleDirektur = Role::create(['name' => 'direktur']);
        $roleWadir1 = Role::create(['name' => 'wadir1']);
        $roleWadir2 = Role::create(['name' => 'wadir2']);
        $roleWadir3 = Role::create(['name' => 'wadir3']);
        $roleKaprodi = Role::create(['name' => 'kaprodi']);
        $roleKajur = Role::create(['name' => 'kajur']);
        $roleP2m = Role::create(['name' => 'p2m']);
        $roleKaunit = Role::create(['name' => 'kaunit']);

        $permissions_mahasiswa = Permission::where('name', 'adminlte.darkmode.toggle')
            ->orWhere('name', 'logout.perform')
            ->orWhere('name', 'home.index')
            ->orWhere('name', 'login.show')
            ->orWhere('name', 'users.editprofile')
            ->orWhere('name', 'users.updateprofile')
            ->pluck('id', 'id')
            ->all();

        $permissions_dosen = Permission::where('name', 'adminlte.darkmode.toggle')
            ->orWhere('name', 'logout.perform')
            ->orWhere('name', 'home.index')
            ->orWhere('name', 'login.show')
            ->orWhere('name', 'users.editprofile')
            ->orWhere('name', 'users.updateprofile')
            ->orWhere('name', 'dashboard')
            ->orWhere('name', 'dashboard_triwulan')
            ->orWhere('name', 'perencanaan.sub_index')
            ->orWhere('name', 'perencanaan.show')
            ->orWhere('name', 'realisasi.index')
            ->orWhere('name', 'realisasi.show')
            ->pluck('id', 'id')
            ->all();

        $permissions_pegawai = Permission::where('name', 'adminlte.darkmode.toggle')
            ->orWhere('name', 'logout.perform')
            ->orWhere('name', 'home.index')
            ->orWhere('name', 'login.show')
            ->orWhere('name', 'users.editprofile')
            ->orWhere('name', 'users.updateprofile')
            ->orWhere('name', 'dashboard')
            ->orWhere('name', 'dashboard_triwulan')
            ->orWhere('name', 'perencanaan.sub_index')
            ->orWhere('name', 'perencanaan.show')
            ->orWhere('name', 'realisasi.index')
            ->orWhere('name', 'realisasi.show')
            ->pluck('id', 'id')
            ->all();

        $permissions_direktur = Permission::where('name', 'adminlte.darkmode.toggle')
            ->orWhere('name', 'logout.perform')
            ->orWhere('name', 'home.index')
            ->orWhere('name', 'login.show')
            ->orWhere('name', 'users.editprofile')
            ->orWhere('name', 'users.updateprofile')
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

        $permissions_wadir1 = Permission::where('name', 'adminlte.darkmode.toggle')
            ->orWhere('name', 'logout.perform')
            ->orWhere('name', 'home.index')
            ->orWhere('name', 'login.show')
            ->orWhere('name', 'users.editprofile')
            ->orWhere('name', 'users.updateprofile')
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

        $permissions_wadir2 = Permission::where('name', 'adminlte.darkmode.toggle')
            ->orWhere('name', 'logout.perform')
            ->orWhere('name', 'home.index')
            ->orWhere('name', 'login.show')
            ->orWhere('name', 'users.editprofile')
            ->orWhere('name', 'users.updateprofile')
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

        $permissions_wadir3 = Permission::where('name', 'adminlte.darkmode.toggle')
            ->orWhere('name', 'logout.perform')
            ->orWhere('name', 'home.index')
            ->orWhere('name', 'login.show')
            ->orWhere('name', 'users.editprofile')
            ->orWhere('name', 'users.updateprofile')
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

        $permissions_kaprodi = Permission::where('name', 'adminlte.darkmode.toggle')
            ->orWhere('name', 'logout.perform')
            ->orWhere('name', 'home.index')
            ->orWhere('name', 'login.show')
            ->orWhere('name', 'users.editprofile')
            ->orWhere('name', 'users.updateprofile')
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

        $permissions_kajur = Permission::where('name', 'adminlte.darkmode.toggle')
            ->orWhere('name', 'logout.perform')
            ->orWhere('name', 'home.index')
            ->orWhere('name', 'login.show')
            ->orWhere('name', 'users.editprofile')
            ->orWhere('name', 'users.updateprofile')
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

        $permissions_p2m = Permission::where('name', 'adminlte.darkmode.toggle')
            ->orWhere('name', 'logout.perform')
            ->orWhere('name', 'home.index')
            ->orWhere('name', 'login.show')
            ->orWhere('name', 'users.editprofile')
            ->orWhere('name', 'users.updateprofile')
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

        $permissions_kaunit = Permission::where('name', 'adminlte.darkmode.toggle')
            ->orWhere('name', 'logout.perform')
            ->orWhere('name', 'home.index')
            ->orWhere('name', 'login.show')
            ->orWhere('name', 'users.editprofile')
            ->orWhere('name', 'users.updateprofile')
            ->orWhere('name', 'dashboard')
            ->orWhere('name', 'dashboard_triwulan')
            ->orWhere('name', 'perencanaan.sub_index')
            ->orWhere('name', 'perencanaan.show')
            ->orWhere('name', 'realisasi.index')
            ->orWhere('name', 'realisasi.show')
            ->orWhere('name', 'realisasi.create')
            ->orWhere('name', 'realisasi.store')
            ->orWhere('name', 'realisasi.edit')
            ->orWhere('name', 'realisasi.update')
            ->orWhere('name', 'laporan.index')
            ->orWhere('name', 'laporan.generate')
            ->orWhere('name', 'laporan.show_pdf')
            ->orWhere('name', 'laporan.reset')
            ->pluck('id', 'id')
            ->all();

        $dosen->assignRole([$roleDosen->id]);
        $pegawai->assignRole([$rolePegawai->id]);
        $direktur->assignRole([$roleDirektur->id]);
        $wadir1->assignRole([$roleWadir1->id]);
        $wadir2->assignRole([$roleWadir2->id]);
        $wadir3->assignRole([$roleWadir3->id]);
        $kaprodi->assignRole([$roleKaprodi->id]);
        $kajur->assignRole([$roleKajur->id]);
        $p2m->assignRole([$roleP2m->id]);
        $kaunit->assignRole([$roleKaunit->id]);

        $roleMahasiswa->syncPermissions($permissions_mahasiswa);
        $roleDosen->syncPermissions($permissions_dosen);
        $rolePegawai->syncPermissions($permissions_pegawai);
        $roleDirektur->syncPermissions($permissions_direktur);
        $roleWadir1->syncPermissions($permissions_wadir1);
        $roleWadir2->syncPermissions($permissions_wadir2);
        $roleWadir3->syncPermissions($permissions_wadir3);
        $roleKaprodi->syncPermissions($permissions_kaprodi);
        $roleKajur->syncPermissions($permissions_kajur);
        $roleP2m->syncPermissions($permissions_p2m);
        $roleKaunit->syncPermissions($permissions_kaunit);
    }
}
