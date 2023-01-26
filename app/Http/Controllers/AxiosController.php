<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Notifications\InvoicePaid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class AxiosController extends Controller
{
    //addToCart
    public function addToCart(Request $request){
        $result = Cart::where('user_id',Auth::user()->id)->where('product_id',$request->productId)->get();
        if(count($result) == 0){
            $cart = new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->product_id = $request->productId;
            $cart->qty = $request->qty;
            $cart->save();
            return response()->json('success',200);
        }else{
            //to show user alerts
            return response()->json('already Exits In Cart!',220);
        }
    }
}
