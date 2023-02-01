<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\OrderList;
use App\Models\TempCartList;
use Illuminate\Http\Request;
use App\Models\CreditCardMethod;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PaymentCCRequest;

class CartController extends Controller
{
    //cart item
    public function cartItem(){
        $carts = Cart::select('carts.*','products.name as productName','products.price as productPrice','products.image as productImage')
                ->leftJoin('products','products.id','carts.product_id')
                ->where('user_id',Auth::user()->id)
                ->get();
         return view('user.cart.cartList',compact('carts'));
    }

    //payment
        public function payment(Request $request)
        {
            // $carts = TempCartList::where('user_id',Auth::user()->id)->get();
            // if(count($carts) > 0){
            //     foreach($carts as $cart){
            //         $cart->delete();
            //     }
            //     logger($carts);
            // }else{
            //     foreach($request->all() as $item){
            //         // logger($item);
            //         $tempCart = TempCartList::where('user_id',Auth::user()->id)->where('product_id',$item['product_id'])->first();
            //         if($tempCart){
            //             $tempCart->user_id = $item['user_id'];
            //             $tempCart->product_id = $item['product_id'];
            //             $tempCart->qty = $item['qty'];
            //             $tempCart->total = $item['total'];
            //             $tempCart->order_code = $item['order_code'];
            //             $tempCart->update();
            //         }else{
            //             $temp = new TempCartList();
            //             $temp->user_id = $item['user_id'];
            //             $temp->product_id = $item['product_id'];
            //             $temp->qty = $item['qty'];
            //             $temp->total = $item['total'];
            //             $temp->order_code = $item['order_code'];
            //             $temp->save();
            //         }
            //     }
            // }
            return view('user.payments.payment');
        }


    //verify payment
    public function verify(PaymentCCRequest $request){
        $payment = new CreditCardMethod();
        $payment->user_id = Auth::user()->id;
        $payment->order_code = $request->order_code;
        $payment->total_price = $request->final_price;
        $payment->card_number = $request->cardNo;
        $payment->expired_date = $request->expired_date;
        $payment->cvv_code = $request->cvv_code;
        $payment->card_name = $request->card_name;
        $payment->name = $request->name;
        $payment->address = $request->address;
        if($request->message){
            $payment->message = $request->message;
        }
        $result = $payment->save();
        if($result){
            $carts = Cart::select('carts.*','products.name as productName','products.price as productPrice','products.image as productImage')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('user_id',Auth::user()->id)
                    ->get();

            foreach($carts as $cart){
                $total = $cart->productPrice * $cart->qty;
                OrderList::create([
                    'user_id' => $cart->user_id,
                    'product_id' => $cart->product_id,
                    'qty' => $cart->qty,
                    'total' => $total,
                    'order_code' => $request->order_code,
                ]);
            }
            $transactionId =  random_int(1,11111999999).'_-_TSIPOS' ; 
            return view('user.payments.successPayment');
        }else{
            //fail
        }

    }

    //paymentSuccess
    public function paymentSuccess(){
        return view('user.payments.successPayment');
    }
}
