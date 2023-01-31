<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
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
    public function payment(Request $request){
        // logger($request->dataFinal['final_price']);
        // logger($request->orderList);
        // $finalPrice = $request->dataFinal['final_price'];
        // logger($finalPrice);
        return view('user.payments.payment');
    }

    //verify payment
    public function verify(PaymentCCRequest $request){
        dd($request->all());
    }

    //paymentSuccess
    public function paymentSuccess(){
        return view('user.payments.successPayment');
    }
}
