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
        if (!empty($request->category_type)) {
            $filter = $request->category_type;
        }
        $dishes = $product->getAllProducts($filter);
        //dd($dishes);
        return view('admin.dish.show', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *

     */
    public function create()
    {
        $categories = Category::all();
        return view('clients/products/add_product', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {

        $request->validate([
            'product-name' => 'required',
            'product-price' => 'required',
            'product-description' => 'required',
            'product-category' => 'required',
            'product-image' => 'required|image'
        ],
            [
                'product-name.required' => 'Name is required',
                'product-price' => 'Price is required',
                'product-description' => 'Description is required',
                'product-category' => 'Category group is required',
                'product-image' => 'Image is required',
                'product-image.image' => 'File must be an image'
            ]);
        if ($request->hasFile('product-image')) {
            $image = $request->file('product-image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/img'), $imageName);
        }
        $new_product = new Product();
        $new_product->Name = $request->input('product-name');
        $new_product->Price = $request->input('product-price');
        $new_product->Description = $request->input('product-description');
        $new_product->Status = 'Stocking';
        //Check the category is exist or not
        $isNewCategory = true;
        $categories = Category::select('CategoryID', 'Title')->get();
        foreach ($categories as $category) {
            if ($category->Title == $request->input('product-category')) {
                $isNewCategory = false;
                $new_product->CategoryID = $category->CategoryID;
                $new_product->Image = $imageName;
            }
        }
        if ($isNewCategory == false) {
            //Add a product to a exist category
            $new_product->save();
        } else {
            //Add a  new category
            $new_category = new Category();
            $new_category->Title = $request->input('product-category');
            $new_category->save();

            //Add new product to new category
            $new_product->CategoryID = $new_category->CategoryID;
            $new_product->Image = $imageName;
            $new_product->save();
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     */
    public function show(Product $product)
    {
        return view('clients/products/show_product', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     */
    public function edit(Request $request)
    {
//        $id = $request->query('id');
//        $product = new Product();
//        $product = $product->getProductById($id)->first();
//        return view('admin.dish.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     */
    public function update(Request $request)
    {
        $request->validate([
            'up_name' => 'required|unique:product,name,'.$request->up_id,
            'up_price' => 'required',
            'up_description' => 'required',
            'up_category' => 'required',
            'up_image' => 'image',
        ],
            [
                'up_name.required' => 'Name is required',
                'up_price' => 'Price is required',
                'up_name.unique' => 'Name already exists',
                'up_description' => 'Description is required',
                'up_category' => 'Category group is required',
                'up_image.image' => 'File must be an image'
            ]);
        if ($request->hasFile('up_image')) {
            $image = $request->file('up_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/img'), $imageName);
        }
        //Check the category is exist or not
        $isNewCategory = true;

        $categories = Category::select('CategoryID', 'Title')->get();
        foreach ($categories as $category) {
            if ($category->Title == $request->up_category) {
                $isNewCategory = false;
                $edit_category_id = $category->CategoryID;
                break;
            }
        }
        if ($isNewCategory == false)
        {
            //Add a product to a exist category
            Product::where('ID',$request->up_id)->update([
                'Name' => $request->up_name,
                'Price' => $request->up_price,
                'Description' => $request->up_description,
                'Status' => $request->up_status,
                'CategoryID' => $edit_category_id
            ]);

        }
        else {
            //Add a  new category
            $new_category = new Category();
            $new_category->Title = $request->up_category;
            $new_category->save();

            //Update product with new category
            Product::where('ID',$request->up_id)->update([
                'Name' => $request->up_name,
                'Price' => $request->up_price,
                'Description' => $request->up_description,
                'Status' => $request->up_status,
                'CategoryID' => $new_category->CategoryID
            ]);

        }
        if($request->hasFile('up_image')) {
            Product::where('ID',$request->up_id)->update([
                'Image'=> $imageName
            ]);
        }
        return response()->json(['status'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     */
    public function destroy(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $id) {
            Product::where('ID', $id)->delete();
        }
        return response()->json(['status' => 'success']);
    }

    public function pagination(Request $request)
    {
        $product = new Product();
        $filter = '';
        if (!empty($request->category_type)) {
            $filter = $request->category_type;
        }
        $dishes = $product->getAllProducts($filter);
        return view('admin.dish.pagination', compact('dishes'))->render();
    }

    public function search(Request $request)
    {
        $product = new Product();
        $filter = '';
        if (!empty($request->category_type)) {
            $filter = $request->category_type;
        }
        $dishes = $product->getProductsBySearch($filter, $request->search_string);

        if ($dishes->count() >= 1) {
            return view('admin.dish.pagination', compact('dishes'))->render();
        } else {
            return response()->json([
                'status' => 'nothing_found'
            ]);
        }
    }

    public function showDishByGroup(Request $request)
    {
        $product = new Product();
        $filter = '';
        if (!empty($request->category_type)) {
            $filter = $request->category_type;
        }
        $dishes = $product->getAllProducts($filter);
        return view('admin.dish.pagination', compact('dishes'))->render();
    }
}
