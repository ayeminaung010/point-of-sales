<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //list
    public function list(){
        $orders = Order::select('orders.*','users.name as username')
                    ->leftJoin('users','users.id','orders.user_id')
                    ->get();
        return view('admin.order.list',compact('orders'));
    }

    //userOrderLists
    public function userOrderLists($id){
        $orderLists = OrderList::where('order_code',$id)
                    ->select('order_lists.*','users.name as username','users.email as email','users.phone as phone','products.image as productImage','products.name as productName')
                    ->leftJoin('users','users.id','order_lists.user_id')
                    ->leftJoin('products','products.id','order_lists.product_id')
                    ->get();

        $order = Order::where('order_code',$id)->get();
        // dd($orderLists[0]->username);
        return view('admin.order.order-lists',compact('orderLists','order'));
    }
}
