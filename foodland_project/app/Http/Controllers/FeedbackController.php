<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    //
    public  function send(Request $request) {
        $request->validate(['rating' => 'required']);
        $feedback = new Feedback();
        $feedback->OrderID = $request->order_id;
        $feedback->Detail = $request->detail;
        $feedback->Rating = $request->rating;
        $feedback->save();
        return response()->json(['status' => 'success']);
    }
}
