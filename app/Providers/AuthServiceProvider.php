<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
		
		if (Schema::hasTable('roles')) {
			$roles = \Spatie\Permission\Models\Role::where('guard_name','web')->get();
			//dd($role);
			foreach($roles as $r){
				Gate::define($r->name, function ($user) use ($r) {
					$roles = $user->roles->pluck('name')->toArray();
					$role = $user->role_aktif;
					if(count($roles)<1)return false;
					if ($roles[$role] == $r->name){
					return true;
					}
					return false;
			});
			}
		}
		/*Gate::define('admin', function ($user) {
			$roles = $user->roles->pluck('name')->toArray();
			$role = $user->role_aktif;
			if(count($roles)<1)return false;
			if ($roles[$role] == 'admin'){
               return true;
			}
			return false;
       });
	   
	   Gate::define('terdaftar', function ($user) {
           $roles = $user->roles->pluck('name')->toArray();
			$role = $user->role_aktif;
			if(count($roles)<1)return false;
			if ($roles[$role] == 'terdaftar'){
               return true;
			}
			return false;
       });
	   
	   Gate::define('pengusul', function ($user) {
           $roles = $user->roles->pluck('name')->toArray();
			$role = $user->role_aktif;
			if(count($roles)<1)return false;
			if ($roles[$role] == 'pengusul'){
               return true;
			}
			return false;
       });
	   
	   Gate::define('operator', function ($user) {
           $roles = $user->roles->pluck('name')->toArray();
			$role = $user->role_aktif;
			if(count($roles)<1)return false;
			if ($roles[$role] == 'operator'){
               return true;
			}
			return false;
       });
	   
	   Gate::define('p3m', function ($user) {
           $roles = $user->roles->pluck('name')->toArray();
			$role = $user->role_aktif;
			if(count($roles)<1)return false;
			if ($roles[$role] == 'p3m'){
               return true;
			}
			return false;
       });
	   
	   Gate::define('direktur', function ($user) {
           $roles = $user->roles->pluck('name')->toArray();
			$role = $user->role_aktif;
			if(count($roles)<1)return false;
			if ($roles[$role] == 'direktur'){
               return true;
			}
			return false;
       });
	   
	   Gate::define('kaprodi', function ($user) {
           $roles = $user->roles->pluck('name')->toArray();
			$role = $user->role_aktif;
			if(count($roles)<1)return false;
			if ($roles[$role] == 'kaprodi'){
               return true;
			}
			return false;
       });*/
	   
        //
    }
}
