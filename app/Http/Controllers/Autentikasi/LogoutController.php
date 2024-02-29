<?php

namespace App\Http\Controllers\Autentikasi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    /**
     * Log out account user.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function perform()
    {
		$user = Auth::user();
        Session::flush();
        
        Auth::logout();
		
		\DB::table('sessions')
            ->where('user_id', $user->id)->delete();
		if (config('services.oauth_server.sso_enable')){
			if($user->status == 2){
				return redirect('login');
			}else{
				return redirect('https://sso.poliwangi.ac.id/keluar');
			}
		}else{
			return redirect('login');
		}
    }
}