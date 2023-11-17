<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

use DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $products = Product::take(5)->get();

        return view('front_end/index',compact('products'))
            ->with(request()->input('page'));
    }

    /**
     * Show the form for creating a new resource.
     *

     */
    public function create()
    {
        $categories = Category::all();
        return view('front_end/add_product',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'Name' => 'required',
            'Price' => 'required',
            'CategoryID'=> 'required',
            'Description'=> 'required',	
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     */
    public function show(Product $product)
    {
        return view('front_end/show_product',compact('product'));
        // return view('front_end/index',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product

     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('front_end/edit_product',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product

     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'Name' => 'required',
            'Price' => 'required',
            'CategoryID'=> 'required',
            'Description'=> 'required',	
        ]);


        $product->update($request->all());

        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product

     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}
