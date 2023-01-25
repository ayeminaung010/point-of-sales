<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
