<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {		
        if(isset(auth()->user()->role_aktif) && !empty(auth()->user()->role_aktif)){
            $view='dashboard.'.auth()->user()->role_aktif;            
            if(View::exists($view))
                return view($view);
        }
        return view('home');
    }
}
