<?php

namespace App\Http\Controllers\Monitor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Core\LoginActivity;

class LoginActivityController extends Controller
{
    public function index()
	{
		
		if(auth()->user()->role('admin')){
			$loginActivities = LoginActivity::with('getUser')->latest()->paginate(10);
		}else{
			$loginActivities = LoginActivity::whereUserId(auth()->user()->id)->latest()->paginate(10);
		}
		return view('monitor.login-activity.list', compact('loginActivities'));
	}
}
