<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'ProductID';
    public $timestamps = false;

    protected $fillable = [
        'ProductID',
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
        $products = DB::table($this->table)
            ->select('product.*','category.Title as category_name')
            ->join('category','category.CategoryID','=','product.CategoryID')
            ->paginate(5);
        if($filters!='' and $filters!='All')
        {
            $products = $products->where('category.Title','=',$filters);
        }
        //dd($products);
        //$products = $products;
        return $products;
    }
}
