<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use App\Models\MobileWallet;
use Illuminate\Http\Request;
use App\Models\CreditCardMethod;

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

        if($order[0]->payment_type == 'Credit-Card'){
            $payment =  CreditCardMethod::where('order_code',$id)->get();
            return view('admin.order.order-lists',compact('orderLists','order','payment'));
        }else{
            $payment = MobileWallet::where('order_code',$id)->get();
            return view('admin.order.order-lists',compact('orderLists','order','payment'));
        }


    }

    //statusChange
    public function statusChange(Request $request){
        $order = Order::where('order_code',$request->order_code)->first();
        $order->status = $request->status;
        $order->update();
        return response()->json('success',200);
    }
}
