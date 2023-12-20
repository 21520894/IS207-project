<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Category;
use App\Http\Controllers\CategoriesController;

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
        if (!empty($request->order_status))
        {
            $filter = $request->order_status;
        } else {
            $filter = '';
        }
        $orders = $this->orders->getOrdersByStatus($filter);
        return view('admin.ecommerce.order', compact('orders'));
    }

    public function showOrderByStatus(Request $request)
    {

        $orders = $this->orders->getOrdersByStatus($request->order_status);
        return view('admin.ecommerce.order_pagination', compact('orders'))->render();
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
    public function update(Request $request)
    {
        //
        $orderId = $request->order_id;
        if($request->up_order_status == 'Finished')
        {
            $newPayment = new Payment();
            $newPayment->PaymentMode = 'COD';
            $newPayment->OrderID = $orderId;
            $newPayment->PaymentTime = Carbon::now();
            $newPayment->save();
            $order = Order::where('OrderID',$orderId)->update(['OrderStatus' => $request->up_order_status]);
        }
        $order = Order::where('OrderID',$orderId)->update(['OrderStatus' => $request->up_order_status]);
        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //

        $ids = $request->ids;
        Order::whereIn('OrderID', $ids)->delete();
        OrderDetail::whereIn('OrderID', $ids)->delete();
        return response()->json(['status' => 'success']);
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
    public function pagination(Request $request)
    {
        $orders = $this->orders->getOrders();
        return view('admin.ecommerce.order_pagination', compact('orders'))->render();
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

    public function orderDetail(Request $request)
    {
        $res = [
            'Product_name' => [],
            'Product_quantity' => [],
            'Product_price' => [],
        ];
        $order = Order::find($request->orderID)->getAttributes();
        $discount = 0;
        if ($order['PromotionID'] != null) {
            $discount = Promotion::where('PromotionID','=',$order['PromotionID'])->first()->Value;
        }
        $orderDetails = OrderDetail::where('OrderID',$request->orderID)->get();
        $subtotal = 0;
        foreach ($orderDetails as $orderDetail) {
            $item = $orderDetail->getAttributes();
            $productName = Product::find($item['ProductID'])->getAttributes()['Name'];
            $productPrice = Product::find($item['ProductID'])->getAttributes()['Price'];
            $subtotal += $productPrice;
            $productPrice = number_format($productPrice, 0, ',', ',');
            array_push($res['Product_name'],$productName);
            array_push($res['Product_quantity'],$item['quantity']);
            array_push($res['Product_price'],$productPrice);
        }
        $user = User::find($order['UserID'])->getAttributes();

        $res['User_address'] = $user['address'];
        $res['sub_total'] = number_format($subtotal, 0, ',', ',');;
        $res['Order_total'] = number_format($order['TotalPrice'], 0, ',', ',');;
        $res['vat'] = number_format(($subtotal)*0.08,0,',',',');
        $res['discount'] = number_format($discount,0,',',',');
        return $res;
    }
}
