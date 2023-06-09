<?php

namespace App\Http\Controllers;

use App\Models\LiqPayService;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Donate;
use App\Models\DonatePayment;
use App\Models\ProductPayment;
use Illuminate\Http\Request;

    class PayController extends Controller {
        public function index(Product $product){
            return view('pages.pay.index',['product'=>$product]);
        }
        public function paymentRequest(Request $request, Product $product, LiqPayService $service)
        {
            $quantity= $request->input('quantity');
            $id = rand(100, 10000);
            return view('pages.pay.request',['quantity'=>$quantity,'product'=>$product,'data'=>$service->getFormData($service->generatePayParams($id,($product->price*$quantity),"$product->title "."x$quantity"))]);
        }
        public function paymentResult(int $quantity, Product $product, Request $request)
        {
            $transaction = $request->get('transaction');
            $payment = new Payment();
            $payment->order_id=$transaction['order_id'];
            $payment->description=$transaction['description'];
            $payment->card_mask=$transaction['card_mask'];
            $payment->currency=$transaction['currency'];
            $payment->amount=$transaction['amount'];
            $payment->result=$transaction['result'];
            $payment->liqpay_order_id=$transaction['liqpay_order_id'];
            $payment->status=$transaction['status'];
            $payment->payment_id=$transaction['payment_id'];
            $payment->paytype=$transaction['paytype'];
            $payment->save();
            
            $productPayment = new ProductPayment();
            $productPayment->product_id = $product->id;
            $productPayment->payment_id = $payment->id;
            $productPayment->quantity=$quantity;
            $productPayment->save();
            
            $product->quantity-=$quantity;
            $product->save();
            return response()->json(['ok'=>true]);
        }
        public function requestPaymentDonate(Donate $donate, Request $request, LiqPayService $service)
        {
            $amount = $request->input('amount');
            $id = rand(10000, 150000);
            return view('pages.pay.donateRequest',['donate'=>$donate,'data'=>$service->getFormData($service->generatePayParams($id,$amount,$donate->title.' : '.$donate->descriptions))]);
        }
        public function resultPaymentDonate(Donate $donate, Request $request)
        {
            $transaction = $request->get('transaction');
            $payment = new Payment();
            $payment->order_id=$transaction['order_id'];
            $payment->description=$transaction['description'];
            $payment->card_mask=$transaction['card_mask'];
            $payment->currency=$transaction['currency'];
            $payment->amount=$transaction['amount'];
            $payment->result=$transaction['result'];
            $payment->liqpay_order_id=$transaction['liqpay_order_id'];
            $payment->status=$transaction['status'];
            $payment->payment_id=$transaction['payment_id'];
            $payment->paytype=$transaction['paytype'];
            $payment->save();

            $donatePayment = new DonatePayment();
            $donatePayment->payment_id=$payment->id;
            $donatePayment->donate_id=$donate->id;
            $donatePayment->save();
            $donate->amount+=$payment->amount;
            $donate->save();
            return response()->json(['ok'=>true]);
        }
    }
 ?>