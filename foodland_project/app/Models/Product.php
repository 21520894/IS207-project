<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = [
        'ID',
        'Name'	,
        'Description',
        'Discount',
        'Price',
        'ProductStatus',
        'PromotionPrice',
        'CategoryID'
    ];
    protected $attributes = [
        'Discount' => '0',


    ];
    public function getAllProducts($filters)
    {
        if($filters!='' and $filters!='All')
        {
            $products = DB::table($this->table)
                ->select('product.*','category.Title as category_name')
                ->join('category','category.CategoryID','=','product.CategoryID')
                ->where('category.Title','=',$filters)
                ->where('product.Status','<>','Stop business')
                ->paginate(3);

        }
        else {
            $products = DB::table($this->table)
                ->select('product.*','category.Title as category_name')
                ->where('product.Status','<>','Stop business')
                ->join('category','category.CategoryID','=','product.CategoryID')
                ->paginate(3);
        }
        return $products;
    }
    public function getAllProductsForClients($filters='')
    {
        if($filters!='' and $filters!='All')
        {
            $products = DB::table($this->table)
                ->select('product.*','category.Title as category_name')
                ->join('category','category.CategoryID','=','product.CategoryID')
                ->where('category.Title','=',$filters)
                ->where('product.Status','<>','Stop business');

        }
        else {
            $products = DB::table($this->table)
                ->select('product.*','category.Title as category_name')
                ->join('category','category.CategoryID','=','product.CategoryID')
                ->where('category.Title','=','Beefsteak')
                ->where('product.Status','<>','Stop business');
        }
        return $products->get();
    }
    public function getProductsBySearch($filters,$search_string)
    {
        if($filters!='' and $filters!='All')
        {
            $products = DB::table($this->table)
                ->select('product.*', 'category.Title as category_name')
                ->join('category', 'category.CategoryID', '=', 'product.CategoryID')
                ->where('category.Title', '=', $filters)
                ->where(function ($query) use ($search_string) {
                    $query->where('Name', 'like', '%' . $search_string . '%')
                        ->orWhere('Price', 'like', '%' . $search_string . '%');
                })
                ->where('product.Status','<>','Stop business')
                ->paginate(3);
        }
        else {
            $products = DB::table($this->table)
                ->select('product.*', 'category.Title as category_name')
                ->join('category', 'category.CategoryID', '=', 'product.CategoryID')
                ->where(function ($query) use ($search_string) {
                    $query->where('Name', 'like', '%' . $search_string . '%')
                        ->orWhere('Price', 'like', '%' . $search_string . '%');
                })
                ->where('product.Status','<>','Stop business')
                ->paginate(3);
        }
        return $products;
    }
    public function getProductsBySearchForClients($filters,$search_string)
    {
        if($filters!='' and $filters!='All')
        {
            $products = DB::table($this->table)
                ->select('product.*', 'category.Title as category_name')
                ->join('category', 'category.CategoryID', '=', 'product.CategoryID')
                ->where('category.Title', '=', $filters)
                ->where('product.Status','<>','Stop business')
                ->where(function ($query) use ($search_string) {
                    $query->where('Name', 'like', '%' . $search_string . '%')
                        ->orWhere('Price', 'like', '%' . $search_string . '%');
                });
        }
        else {
            $products = DB::table($this->table)
                ->select('product.*', 'category.Title as category_name')
                ->join('category', 'category.CategoryID', '=', 'product.CategoryID')
                ->where('product.Status','<>','Stop business')
                ->where(function ($query) use ($search_string) {
                    $query->where('Name', 'like', '%' . $search_string . '%')
                        ->orWhere('Price', 'like', '%' . $search_string . '%');
                });
        }
        return $products->get();
    }
    public function getProductById($id)
    {
        $product =  DB::table($this->table)
            ->select('product.*','category.Title as category_name')
            ->join('category','category.CategoryID','=','product.CategoryID')
            ->where('product.ID','=',$id);
        return $product->get();
    }
}
