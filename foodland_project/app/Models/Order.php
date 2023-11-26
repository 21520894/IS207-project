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

    public function getOrders($filters)
    {
        $orders = DB::table($this->table)
            ->select('orders.*','users.name as customer_name','users.phone as customer_phone',
            'payment.PaymentMode as payment_method')
            ->join('users','users.id','=','orders.UserID')
            ->join('payment','payment.OrderID','=','orders.OrderID');
        if($filters!='' and $filters!='All')
        {
            $oders = $orders->get();
        }
        $oders = $orders->get();
        return $oders;
    }
}
