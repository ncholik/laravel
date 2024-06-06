<?php

namespace Database\Seeders;

use App\Models\Core\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Hash;
use DB;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Artisan::call('permission:create-permission-routes');

        $user = User::create([
            'name' => 'Administrator',
			'email' => 'ncadvertise@gmail.com',
			'username' => 'super',
			'password' => Hash::make('admin!@#123'),
			'unit' => 0,
			'staff' => 0,
            'role_aktif' => 'admin',
			'status' => 2
        ]);
        
  

        $role = Role::create(['name' => 'admin']);
        
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
		
		$permissions = Permission::where('name','adminlte.darkmode.toggle')->orWhere('name','logout.perform')->orWhere('name','home.index')->orWhere('name','login.show')->pluck('id','id')->all();
		
		$role = Role::create(['name' => 'terdaftar']);
		$role->syncPermissions($permissions);
		$role = Role::create(['name' => 'operator']);
		$role->syncPermissions($permissions);
		
    }
}