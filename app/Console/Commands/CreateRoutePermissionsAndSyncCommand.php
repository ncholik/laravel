<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateRoutePermissionsAndSyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:create-permission-routes-sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a permission routes & sync.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $routes = Route::getRoutes()->getRoutes();

        foreach ($routes as $route) {
            if ($route->getName() != '' && $route->getAction()['middleware']['0'] == 'web') {
                $permission = Permission::where('name', $route->getName())->first();

                if (is_null($permission)) {
                    permission::create(['name' => $route->getName()]);
                }
            }
        }
		
		$role = Role::where('id',1)->first();
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
		
        $this->info('Permission routes added successfully.');
    }
}