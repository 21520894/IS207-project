<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $primaryKey = 'CategoryID';
    public $timestamps = false;

    protected $fillable = [
        'CategoryID',
        'Title',
        'Image',
        'IsActive'
    ];

}
// protected static function boot()
//     {
//         parent::boot();

//         static::creating(function ($product) {
//             $latestProduct = static::latest()->first();
//             $latestId = $latestProduct ? $latestProduct-> ProductID: null;
//             $newIdNumber = $latestId ? (int)substr($latestId, 3) + 1 : 1;

//             $product->id = 'CA' . str_pad($newIdNumber, 2, '0', STR_PAD_LEFT);
//         });
    // }