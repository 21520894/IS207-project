<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

use DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use function Laravel\Prompts\alert;

session_start();

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $product = new Product();
        $filter = '';
        if(!empty($request->category_type))
        {
            $filter = $request->category_type;
        }
        $dishes = $product->getAllProducts($filter);
        //dd($dishes);
        return view('admin.dish.show',compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *

     */
    public function create()
    {
        $categories = Category::all();
        return view('clients/products/add_product',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required',
            'product_description'=> 'required',
            'product_category' => 'required'
        ],
        [
            'product_name.required' => 'Name is required',
            'product_price' => 'Price is required',
            'product_description' => 'Description is required',
            'product_category' => 'Category group is required'
        ]);

        $new_product = new Product();
        $new_product->Name = $request->product_name;
        $new_product->Price = $request->product_price;
        $new_product->Description = $request->product_description;

        $categories = Category::select('CategoryID','Title')->get();
        foreach ($categories as $category)
        {
            if($category->Title == $request->product_category) {
                $new_product->CategoryID = $category->CategoryID;
            }
        }
        $new_product->save();
        return response()->json(['status'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     */
    public function show(Product $product)
    {
        return view('clients/products/show_product',compact('product'));
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
        return view('clients/products/edit_product',compact('product','categories'));
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
