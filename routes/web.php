<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['namespace' => 'App\Http\Controllers\Core'], function()
{ 
	Route::group(['middleware' => ['guest']], function() {
		Route::get('/', function () {
			return redirect()->route('home.index');//return view('welcome');
		});        
	});
	
	Route::group(['middleware' => ['auth', 'permission']], function() {
		/**
		 * Home Routes
		 */
		Route::get('/home', 'HomeController@index')->name('home.index');
		
		/**
         * User Routes
         */
        Route::group(['prefix' => 'users'], function() {
            Route::get('/', 'UsersController@index')->name('users.index');
            Route::get('/create', 'UsersController@create')->name('users.create');
            Route::post('/create', 'UsersController@store')->name('users.store');
            Route::get('/{user}/show', 'UsersController@show')->name('users.show');
            Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
            Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
            Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
			Route::get('/{user}/tukaruser', 'UsersController@tukaruser')->name('users.tukaruser');
            Route::get('/profile', 'UsersController@editProfile')->name('users.editprofile');
            Route::patch('/{user}/updateprofile', 'UsersController@updateProfile')->name('users.updateprofile');
        });
		
		Route::group(['prefix' => 'menus'], function() {
            Route::get('/', 'MenusController@index')->name('menus.index');
            Route::post('/', 'MenusController@simpan')->name('menus.simpan');
            Route::get('/create', 'MenusController@create')->name('menus.create');
            Route::post('/create', 'MenusController@store')->name('menus.store');
            Route::get('/{menu}/show', 'MenusController@show')->name('menus.show');
            Route::get('/{menu}/edit', 'MenusController@edit')->name('menus.edit');
            Route::patch('/{menu}/update', 'MenusController@update')->name('menus.update');
            Route::get('/{menu}/delete', 'MenusController@destroy')->name('menus.destroy');
        });
		
		Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);	
	});
});

Route::group(['namespace' => 'App\Http\Controllers\Autentikasi'], function()
{   
    

    Route::group(['middleware' => ['guest']], function() {
		
		/**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
		
		/*
		*SSO
		*/
		Route::get('/oauth/login', 'OAuthController@redirect')->name('ssoLogin');
		Route::get('/oauth/callback', 'OAuthController@callback');
		Route::get('/oauth/refresh', 'OAuthController@refresh');

    });

    Route::group(['middleware' => ['auth', 'permission']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
		
		//switch peran
		Route::post('/peran', 'SwitchController@perform')->name('beralih.peran');
		
		
		
    });
});

Route::group(['namespace' => 'App\Http\Controllers\Monitor'], function()
{   
    

    Route::group(['middleware' => ['guest']], function() {
		
		

    });

    Route::group(['middleware' => ['auth', 'permission']], function() {
		/*
		*Monitor Login device
		*/
        Route::get('/logged-in-devices', 'LoggedInDeviceManager@index')->name('logged-in-devices.list');
		Route::get('/logout/all', 'LoggedInDeviceManager@logoutAllDevices')->name('logged-in-devices.logoutAll');
		Route::get('/logout/{device_id}', 'LoggedInDeviceManager@logoutDevice')->name('logged-in-devices.logoutSpecific');
		
		Route::get('/login-activity', 'LoginActivityController@index')->name('logged-activity.list');
		
    });
});



//require_once(__DIR__ . '/partial/berita.php');