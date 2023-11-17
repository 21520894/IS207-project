<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class category_product extends Controller
{
    public function add_product(Request $request){
        $data = array();
        $data["Name"] = $request->name;
        $data["Price"] = $request->price;
        $data["Description"] = $request->describe;
    }
    public function list_product(){
        
    }
}
