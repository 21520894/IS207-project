<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    private $orders;
    public function __construct()
    {
        $this->orders = new Order();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = $this->orders->getOrders();

        return view('admin.ecommerce.order',compact('orders'));
    }
    public function showOrderByStatus(Request $request){

        $orders = $this->orders->getOrdersByStatus($request->order_status);
        return view('admin.ecommerce.order_pagination',compact('orders'))->render();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    //Search orders
    public function search(Request $request)
    {
        $product = new Order();
        $filter = '';
        if (!empty($request->category_type)) {
            $filter = $request->category_type;
        }
        $orders = $product->getOrdersBySearch($filter, $request->search_string);

        if ($orders->count() >= 1) {
            return view('admin.ecommerce.order_pagination', compact('orders'))->render();
        } else {
            return response()->json([
                'status' => 'nothing_found'
            ]);
        }
    }
    public function searchByDate(Request $request)
    {
        $product = new Order();
        $filter = '';
        if (!empty($request->category_type)) {
            $filter = $request->category_type;
        }
        $orders = $product->getOrdersByDate($filter, $request->date);

        if ($orders->count() >= 1) {
            return view('admin.ecommerce.order_pagination', compact('orders'))->render();
        } else {
            return response()->json([
                'status' => 'nothing_found'
            ]);
        }
    }
}
