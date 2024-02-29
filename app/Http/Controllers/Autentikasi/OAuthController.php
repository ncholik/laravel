<?php

namespace App\Http\Controllers\Autentikasi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use App\Models\Core\User;
use Auth;
use Hash;
use Illuminate\Support\Str;

class OAuthController extends Controller
{
    use AuthenticatesUsers;

    public function redirect(){
        $queries = http_build_query([
            'client_id' => config('services.oauth_server.client_id'),
            'redirect_uri' => config('services.oauth_server.redirect'),
            'response_type' => 'code',
        ]);
        return redirect(config('services.oauth_server.uri') . '/oauth/authorize?' . $queries);
    }

    public function callback(Request $request)
    {
        
        $response = Http::withoutVerifying()->post(config('services.oauth_server.uri') . '/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => config('services.oauth_server.client_id'),
            'client_secret' => config('services.oauth_server.client_secret'),
            'redirect_uri' => config('services.oauth_server.redirect'),
            'code' => $request->code
        ]);

        $response = $response->json();

        $this->authAfterSso($response);
        
        
        
        if (!isset($response['access_token'])) {
            return redirect('/');
        }
		
		$request->user()->token()->delete();
		
        $request->user()->token()->create([
            'access_token' => $response['access_token'],
            'expires_in' => $response['expires_in'],
            'refresh_token' => $response['refresh_token']
        ]);

        return redirect('/');
    }

    //digunakan untuk transfer data user ke client

    protected function authAfterSso($response){
        //dd($response);
        if (!isset($response['access_token'])) {
            return redirect('/');
        }
        $response = Http::withoutVerifying()->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $response['access_token']
        ])->get(config('services.oauth_server.uri') . '/api/user');

        if ($response->status() === 200) {
            $SSOUser = $response->json();
        }else return redirect('/');
		
		//echo $SSOUser['unit'];
		//echo $SSOUser['staff'];
        //dd($SSOUser);
		

		
        $users  =   User::where(['username' => $SSOUser['username']])->first();
        if($users){
			Auth::login($users,true);
			Session::flush();        
			Auth::logout();
			
            Auth::login($users,true);
			$users->unit = $SSOUser['unit'];
			$users->staff = $SSOUser['staff'];
			$users->save();
			
			\DB::table('sessions')
            ->where('user_id', $users->id)
            ->where('id', '!=', \Session::getId())->delete();
			
            $users->token()->delete();
			
			
        }else{
            $users = User::create([
                'name'   => $SSOUser['name'],
				'email'   => $SSOUser['email'],
				'username'   => $SSOUser['username'],
				'password'	=> Hash::make(Str::random(11)),
				'unit'   => $SSOUser['unit'],
				'staff'   => $SSOUser['staff'],
				'status' => 1
            ]);
			if( $SSOUser['staff'] == 3 || $SSOUser['staff'] == 4 ){
				$users->syncRoles(3);
			}else $users->syncRoles(2);
            Auth::login($users,true);
			
            //Komen Untuk Mengijinkan Login Lebih dari 1 device
			\DB::table('sessions')
            ->where('user_id', $users->id)
            ->where('id', '!=', \Session::getId())->delete();
        }
		
        
    }
	
	public function refresh(Request $request)
    {
        //dd($request->user()->token->refresh_token);
        $response = Http::withoutVerifying()->post(config('services.oauth_server.uri') . '/oauth/token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $request->user()->token->refresh_token,
            'client_id' => config('services.oauth_server.client_id'),
            'client_secret' => config('services.oauth_server.client_secret'),
            'redirect_uri' => config('services.oauth_server.redirect'),
        ]);
        //dd($response);
        if ($response->status() !== 200) {
            $request->user()->token()->delete();

            return redirect('/')
                ->withStatus('Authorization failed from OAuth server.');
        }else $this->ssoLogout($request);

        $response = $response->json();
        $request->user()->token()->update([
            'access_token' => $response['access_token'],
            'expires_in' => $response['expires_in'],
            'refresh_token' => $response['refresh_token']
        ]);

        return redirect('/');
    }

}
