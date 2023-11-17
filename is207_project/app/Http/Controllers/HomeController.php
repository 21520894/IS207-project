<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
class HomeController extends Controller
{
    public function index()
    {

        return view('clients/user/home');
    }
    public function menu_page()
    {
        return view('clients/user/menu');
    }
    public function order_page()
    {
        return view('clients/user/order');
    }

}
