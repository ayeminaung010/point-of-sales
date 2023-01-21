<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //cart item
    public function cartItem(){
        return view('user.cart.cartList');
    }
}
