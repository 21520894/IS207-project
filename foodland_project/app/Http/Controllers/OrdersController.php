<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
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
        $orders = $this->orders->getOrders();

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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $ids = $request->ids;
        Order::where('OrderID', $ids)->delete();
        OrderDetail::where('OrderID', $ids)->delete();
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
        $orderDetails = OrderDetail::where('OrderID',$request->orderID)->get();
        foreach ($orderDetails as $orderDetail) {
            $item = $orderDetail->getAttributes();
            $productName = Product::find($item['ProductID'])->getAttributes()['Name'];
            $productPrice = Product::find($item['ProductID'])->getAttributes()['Price'];
            $productPrice = number_format($productPrice, 0, ',', ',');


            array_push($res['Product_name'],$productName);
            array_push($res['Product_quantity'],$item['quantity']);
            array_push($res['Product_price'],$productPrice);

        }
        $user = User::find($order['UserID'])->getAttributes();

        $res['User_address'] = $user['address'];
        $res['Order_total'] = number_format($order['TotalPrice'], 0, ',', ',');;
        return $res;
    }
    public function getRevenueByMonths()
    {
        $revenueByMonths = Order::selectRaw('MONTH(OrderTime) as month, SUM(TotalPrice) as revenue')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $revenueData = [];
        foreach ($revenueByMonths as $revenue) {
            $revenueData[$revenue->month] = $revenue->revenue;
        }

        $monthlyRevenue = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthlyRevenue[] = $revenueData[$month] ?? 0;
        }

        return $monthlyRevenue;
    }
    public function getRevenue(Request $request){
        $month = $request->input('month');
        $year = $request->input('year');
        $daysInMonth = $request->input('daysInMonth');
        
        $revenueData = [];

        // Lặp qua từng ngày trong tháng
        for ($day = 1; $day <= $daysInMonth; $day++) {
            // Tạo ngày đầy đủ từ tháng, năm và ngày hiện tại
            $date = sprintf('%04d-%02d-%02d', $year, $month, $day);

            // Truy xuất doanh thu từ cơ sở dữ liệu dựa trên ngày
            $revenue = Order::whereDate('OrderTime', $date)->sum('TotalPrice');

            // Thêm thông tin doanh thu vào mảng
            $revenueData[$day] = $revenue;
        }

        // Trả về mảng doanh thu dưới dạng JSON
        return response()->json($revenueData);
    }
}
