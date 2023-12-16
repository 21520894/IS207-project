<?php
use App\Models\Category;
use App\Models\Product;
use http\Env\Request;
function getAllCategories()
{
    $categories = Category::all();
    return $categories;
}




