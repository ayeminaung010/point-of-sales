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
            $alreadyCart = Cart::where('product_id',$request->productId)->where('user_id',Auth::user()->id)->first();
            $alreadyCart->qty =   $alreadyCart->qty + 1;
            $alreadyCart->update();
            return response()->json('success added new Qty!',220);
        }
    }

    //addCountCart
    public function addCountCart(Request $request){
        $result = Cart::where('product_id',$request->productId)->where('user_id',Auth::user()->id)->get();
        if(count($result) ==  0){
            $cart = new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->product_id = $request->productId;
            $cart->qty = $request->orderCount;
            $cart->save();
            return response()->json('success',200);
        }else{
            if($request->orderCount > 1){
                $alreadyCart = Cart::where('product_id',$request->productId)->where('user_id',Auth::user()->id)->first();
                $alreadyCart->qty = $alreadyCart->qty + $request->orderCount;
                $alreadyCart->update();
                return response()->json('success added new Qty',220);
            }
        }
    }

    //removeFromCart
    public function removeFromCart(Request $request){
        $cart = Cart::where('id',$request->cartId)->where('user_id',Auth::user()->id)->first();
        $cart->delete();
        return response()->json('cart item deleted..',220);
    }

    //countUpdate
    public function countUpdate(Request $request){
        $cart  = Cart::where('id',$request->cartId)->where('user_id',Auth::user()->id)->first();
        $cart->qty = $request->qty;
        $cart->update();
        return response()->json('qty changes..',220);
    }

    //clearCart
    public function clearCart(){
        $carts = Cart::select();
        $carts->delete();
        return response()->json('removed all carts..',220);
    }
}
