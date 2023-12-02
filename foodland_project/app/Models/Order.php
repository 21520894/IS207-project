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
            ->join('payment','payment.OrderID','=','orders.OrderID')
            ->paginate(5);
        return $orders;
    }
    public function getOrdersByStatus($filters)
    {
        $orders = DB::table($this->table)
            ->select('orders.*','users.name as customer_name','users.phone as customer_phone',
                'payment.PaymentMode as payment_method')
            ->join('users','users.id','=','orders.UserID')
            ->join('payment','payment.OrderID','=','orders.OrderID')
            ->paginate(5);
        if($filters!='' and $filters!='All')
        {
            $orders = DB::table($this->table)
                ->select('orders.*','users.name as customer_name','users.phone as customer_phone',
                    'payment.PaymentMode as payment_method')
                ->join('users','users.id','=','orders.UserID')
                ->join('payment','payment.OrderID','=','orders.OrderID')
                ->where('orders.OrderStatus','=',$filters)
                ->paginate(5);
        }
        return $orders;
    }
}
