<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'OrderID';
    public $timestamps = false;

    public function getOrders()
    {
        $orders = DB::table($this->table)
            ->select('orders.*','users.name as customer_name','users.phone as customer_phone',
            'payment.PaymentMode as payment_method')
            ->join('users','users.id','=','orders.UserID')
            ->leftjoin('payment','payment.OrderID','=','orders.OrderID')
            ->paginate(5);
        return $orders;
    }
    public function getOrdersByStatus($filters='')
    {
        $orders = DB::table($this->table)
            ->select('orders.*','users.name as customer_name','users.phone as customer_phone',
                'payment.PaymentMode as payment_method')
            ->join('users','users.id','=','orders.UserID')
            ->leftjoin('payment','payment.OrderID','=','orders.OrderID')
            ->paginate(5);
        if($filters!='' and $filters!='All')
        {
            $orders = DB::table($this->table)
                ->select('orders.*','users.name as customer_name','users.phone as customer_phone',
                    'payment.PaymentMode as payment_method')
                ->join('users','users.id','=','orders.UserID')
                ->leftjoin('payment','payment.OrderID','=','orders.OrderID')
                ->where('orders.OrderStatus','=',$filters)
                ->paginate(5);
        }
        return $orders;
    }
    public function getOrdersBySearch($filters,$search_string)
    {
        $orders = DB::table($this->table)
            ->select('orders.*','users.name as customer_name','users.phone as customer_phone',
                'payment.PaymentMode as payment_method')
            ->join('users','users.id','=','orders.UserID')
            ->leftjoin('payment','payment.OrderID','=','orders.OrderID')
            ->where(function ($query) use ($search_string) {
                $query->where('users.name', 'like', '%' . $search_string . '%')
                    ->orWhere('users.phone', 'like', '%' . $search_string . '%');
            })
            ->paginate(5);
        if($filters!='' and $filters!='All')
        {
            $orders = DB::table($this->table)
                ->select('orders.*','users.name as customer_name','users.phone as customer_phone',
                    'payment.PaymentMode as payment_method')
                ->join('users','users.id','=','orders.UserID')
                ->leftjoin('payment','payment.OrderID','=','orders.OrderID')
                ->where('orders.OrderStatus','=',$filters)
                ->where(function ($query) use ($search_string) {
                    $query->where('customer_name', 'like', '%' . $search_string . '%')
                        ->orWhere('customer_phone', 'like', '%' . $search_string . '%');
                })
                ->paginate(5);
        }
        return $orders;
    }
    public function getOrdersByDate($filters,$date)
    {
        $orders = DB::table($this->table)
            ->select('orders.*','users.name as customer_name','users.phone as customer_phone',
                'payment.PaymentMode as payment_method')
            ->join('users','users.id','=','orders.UserID')
            ->leftjoin('payment','payment.OrderID','=','orders.OrderID')
            ->whereDate('orders.OrderTime','=',$date)
            ->paginate(5);
        if($filters!='' and $filters!='All')
        {
            $orders = DB::table($this->table)
                ->select('orders.*','users.name as customer_name','users.phone as customer_phone',
                    'payment.PaymentMode as payment_method')
                ->join('users','users.id','=','orders.UserID')
                ->leftjoin('payment','payment.OrderID','=','orders.OrderID')
                ->where('orders.OrderStatus','=',$filters)
                ->where('DATE(orders.OrderTime)','=',$date)
                ->paginate(5);
        }
        return $orders;
    }
}
