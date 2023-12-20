<?php
use App\Models\Category;
use App\Models\Product;
use http\Env\Request;
use App\Models\Feedback;
function getAllCategories()
{
    $categories = Category::all();
    return $categories;
}
function getFeedbackRating($orderId)
{
    $rating = Feedback::where('OrderID','=',$orderId)->first();
    if(!empty($rating))
     return $rating->Rating;
    return 0;
}

function getFeedbackDetail($orderId)
{
    $detail = Feedback::where('OrderID',$orderId)->first();
    if(!empty($detail))
        return $detail->Detail;
    return '';
}





