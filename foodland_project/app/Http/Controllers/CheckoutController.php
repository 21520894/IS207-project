<?php

namespace App\Http\Controllers;

use App\Models\feedback;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Promotion;
use App\Models\Vnpay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class CheckoutController extends Controller
{
    //
    public  function vnpayPayment(Request $request)
    {
        $paymentMode = $request->input('order__payment');
        $product_ids = $request->input(['product_ids']);
        $quantity = $request->input(['quantity']);
        $voucher = $request->input(['order_voucher']);
        $promotionId = Promotion::where('CODE','=',$voucher)->first();
        $notes = $request->input(['cart-item__note-input']);

        if($product_ids == null) return redirect('/#menu__page');


        if($paymentMode == 'VNPAY')
        {
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = route('vnpay.return');
            $vnp_TmnCode = "JOQTLCSQ";
            $vnp_HashSecret = "RPGQGMSKNCOQZMMUUPCFHABTRECZQIBZ";

            $vnp_TxnRef =  time() . '-' . auth()->id() . '-' . uniqid();
            $vnp_OrderInfo = 'thanh toan don hang test';
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $request->input(['total']) * 100;
            $vnp_Locale = 'en';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                if($promotionId){
                    return redirect($vnp_Url)->with([
                        'product_ids' => $product_ids,
                        'quantity' => $quantity,
                        'promotion_id' => $promotionId->PromotionID,
                        'payment_mode' => $paymentMode
                    ]);
                }
                return redirect($vnp_Url)->with([
                    'product_ids' => $product_ids,
                    'quantity' => $quantity,
                    'payment_mode' => $paymentMode
                ]);
                die();
            } else {
                echo json_encode($returnData);
            }
        }
        else if($paymentMode == 'COD') {
            $request->totalPrice = $request->input(['total']);
            $request->payment_mode = $paymentMode;
            if($promotionId) $request->promotion_id = $promotionId->PromotionID;
            $this->codReturn($request);
            return redirect('/order-progress')->with(['order_status' => 'success','payment_mode' => 'COD']);
        }
    }
    public function codReturn(Request $request)
    {

        $notes = $request['cart-item__note-input'];
        $productOrdered = $request->product_ids;
        $productQuantity = $request->quantity;
        $promotionId = $request->promotion_id;
        $newOrder = new Order();
        $newOrder->OrderStatus = 'Processing';
        $newOrder->TotalPrice = $request->totalPrice;
        $newOrder->UserID = Auth::user()->id;
        if($promotionId) $newOrder->PromotionID = $promotionId;
        $newOrder->save();


        for($i=0;$i < count($productOrdered);$i++)
        {
            $newOrderDetail = new OrderDetail();
            $newOrderDetail->OrderID = $newOrder->OrderID;
            $newOrderDetail->ProductID = $productOrdered[$i];
            $newOrderDetail->Quantity = $productQuantity[$i];
            if($notes[$i] != null) $newOrderDetail->Note = $notes[$i];
            $newOrderDetail->save();
        }
    }
    public function vnpayReturn(Request $request)
    {
        $productOrdered = $request->session()->get('product_ids');
        $productQuantity = $request->session()->get('quantity');
        $promotionId = $request->session()->get('promotion_id');
        if ($_GET['vnp_ResponseCode'] == '00')
        {
            $newOrder = new Order();
            $newOrder->OrderStatus = 'Processing';
            $newOrder->TotalPrice = $_GET['vnp_Amount']/100;
            $newOrder->UserID = Auth::user()->id;
            if($promotionId) $newOrder->PromotionID = $promotionId;
            $newOrder->save();

            for($i=0;$i < count($productOrdered);$i++)
            {
                $newOrderDetail = new OrderDetail();
                $newOrderDetail->OrderID = $newOrder->OrderID;
                $newOrderDetail->ProductID = $productOrdered[$i];
                $newOrderDetail->Quantity = $productQuantity[$i];
                $newOrderDetail->save();
            }

            $newPayment = new Payment();
            $newPayment->PaymentMode = 'VNPAY';
            $newPayment->BankCode = $_GET['vnp_BankCode'];
            $newPayment->CardType = $_GET['vnp_CardType'];
            $newPayment->PaymentTime = $_GET['vnp_PayDate'];
            $newPayment->ResponseCode = $_GET['vnp_ResponseCode'];
            $newPayment->TransactionNo = $_GET['vnp_TransactionNo'];
            $newPayment->TransactionStatus = $_GET['vnp_TransactionStatus'];
            $newPayment->TxnRef = $_GET['vnp_TxnRef'];
            $newPayment->OrderID = $newOrder->OrderID;
            $newPayment->save();
            return redirect('/order-progress')->with(['order_status' => 'success']);
        }
    }

    public function orderProgress(Request $request)
    {

        $status = $request->order_status;
        $userID = Auth::user()->id;
        $latestOrder = Order::where('UserID', $userID)
            ->latest('OrderTime')
            ->first();
        if(!empty($latestOrder))
        {
            $payment_mode = Payment::where('OrderID',$latestOrder->OrderID)->first();
            $feedback = Feedback::where('OrderID',$latestOrder->OrderID)->first();
        }
        if(!empty($payment_mode))
        {
            $payment_mode =$payment_mode->PaymentMode;
        }
        else {
            $payment_mode = 'COD';
        }
        if(!empty($feedback))
        {
            $feedback = 'done';
        }
        else {
            $feedback = 'none';
        }

        if(!empty($latestOrder->PromotionID)){
            $voucher = Promotion::where('PromotionID','=',$latestOrder->PromotionID)->first();
        }
        else {
            $voucher = '';
        }
        if(!empty($latestOrder)) {
            $latestOrderDetail = OrderDetail::where('OrderID',$latestOrder->OrderID)
                ->join('product','orderdetail.ProductID','=','product.ID')
                ->select('ProductID','product.Name','product.Price','product.Image','orderdetail.Note')
                ->get();
            return view("clients.user.orderProgress",compact('latestOrder','latestOrderDetail','voucher','status','feedback','payment_mode'));
        }
        return view("clients.user.orderProgress",compact('latestOrder','voucher','status','feedback','payment_mode'));
    }
    public function applyVoucher(Request $request)
    {
        $request->validate(['voucher_code' => 'exists:promotion,CODE'],['voucher_code.exists' => 'This voucher does not exists!']);
        $request->validate([
            'voucher_code' => [
                function ($attribute, $value, $fail) use ($request) {
                    $promotion = Promotion::where('CODE', $value)
                        ->whereDate('DateEnd', '>=', Carbon::now())
                        ->first();
                    if (!$promotion) {
                        $fail('This voucher has expired!');
                    }
                },
            ],
        ]);
        $request->validate([
            'voucher_code' => [
                function ($attribute, $value, $fail) use ($request) {
                    $promotion = Promotion::where('CODE', $value)->first();
                    $total = intval($request->total);
                    $constraint = intval($promotion->constraint);
                    if ($total < $constraint) {
                        $fail('The total order value does not meet the minimum required for this voucher!');
                    }
                },
            ],
        ]);
        $discount = Promotion::where('CODE', $request->voucher_code)->first();
        return response()->json([
            'status' => 'success',
            'discount' => $discount->Value,
        ]);
    }

    public function cancelOrder(Request $request)
    {
        $order = Order::where('OrderID',$request->input('order_id'))->update(['OrderStatus' => 'Cancel']);
        return redirect('/#order__page');
    }
}
