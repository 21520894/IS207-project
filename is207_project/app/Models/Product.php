<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID');
    }


}
