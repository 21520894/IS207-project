<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!session()->has('message')) {
            session()->flash('message', 'Please Login to order');
        }
        return view('clients/user/home');
    }
    public function menu()
    {
        return redirect('/#menu__page');
    }
    public function order()
    {
        if(Auth::check())
        {
            return redirect('/#order__page');
        }
        else {
            return redirect('/')->with('message', 'Please Login');
        }
    }
}
