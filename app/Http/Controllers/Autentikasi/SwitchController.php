<?php

namespace App\Http\Controllers\Autentikasi;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Core\User;

class SwitchController extends Controller
{
    
    /**
     * Handle switching role
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function perform(Request $request)
    {
		//dd($request);
        $request->validate([
            'role' => 'required|numeric',
        ]);
		
		auth()->user()->role_aktif = $request->role;
		
		if(auth()->user()->save()) return redirect()->route('home.index')->with('success_message', 'Berhasil beralih peran');
		else return redirect()->route('home.index')->with('warning_message', 'Gagal beralih peran');
    }

}