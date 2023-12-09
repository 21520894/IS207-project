<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;

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
        $categories = Category::all();
        if (!session()->has('message')) {
            session()->flash('message', 'Please Login to order');
        }
        $products = new Product();
        $products = $products->getAllProductsForClients();
        return view('clients/user/home',compact('categories','products'));
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
