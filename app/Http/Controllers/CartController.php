<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\MobileWallet;
use App\Models\TempCartList;
use Illuminate\Http\Request;
use App\Models\CreditCardMethod;
use App\Http\Requests\WalletRequest;
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
        $carts = Cart::where('user_id',Auth::user()->id)->get();
        if(count($carts) === 0){
            return redirect()->route('user#home');
        }else{
            $payment = new CreditCardMethod();
            $payment->user_id = Auth::user()->id;
            $payment->order_code = $request->order_code;
            $payment->total_price = $request->final_price;
            $payment->card_number = $request->cardNo;
            $payment->expired_date = $request->expired_date;
            $payment->cvv_code = $request->cvv_code;
            $payment->card_name = $request->card_name;
            $payment->name = $request->name;
            $payment->email = $request->email;
            $payment->phone = $request->phone;
            $payment->address = $request->address;
            if($request->message){
                $payment->message = $request->message;
            }
            $result = $payment->save();
            // $orderCode;
            if($result){
                $finalPrice = 0;
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
                    $finalPrice += $total ; //deli fee
                    $order = new Order();
                    $order->user_id = Auth::user()->id;
                    $order->order_code = $request->order_code;
                    $order->total_price = $finalPrice;
                    $order->save();
                }
                $transactionId =  random_int(1,11111999999).'_-_TSIPOS' ;
                Cart::where('user_id',Auth::user()->id)->delete();

                toastr()->success('Order Success');

                $data = [
                    'method'=> 'Credit Card',
                    'phone' => Auth::user()->phone,
                    'email' => Auth::user()->email,
                    'transactionId' => $transactionId,
                ];
                return view('user.payments.successPayment',compact('data'));
            }else{
                toastr()->error('Payment Failed!');
                return back();
            }
        }
    }

    //verifyWallet
    public function verifyWallet(WalletRequest $request){

        $carts = Cart::where('user_id',Auth::user()->id)->get();
        if(count($carts) === 0){
            return redirect()->route('user#home');
        }else{
            $payment = new MobileWallet();
            $payment->user_id = Auth::user()->id;
            $payment->payment_name = $request->paymentMethod;
            $payment->order_code = $request->order_code;
            $payment->total_price = $request->final_price;
            $payment->name = $request->name;
            $payment->email = $request->email;
            $payment->phone = $request->phone;
            $payment->address = $request->address;
            if($request->message){
                $payment->message = $request->message;
            }
            $imgName = uniqid() . '_' .$request->file('image')->getClientOriginalName();

            $request->file('image')->storeAs('public/img/user/payment',$imgName);
            $payment->image = $imgName;
            $result = $payment->save();

            if($result){
                $finalPrice = 0;
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
                    $finalPrice += $total ; //deli fee
                    $order = new Order();
                    $order->user_id = Auth::user()->id;
                    $order->order_code = $request->order_code;
                    $order->total_price = $finalPrice;
                    $order->save();
                }
                $transactionId =  random_int(1,11111999999).'_-_TSIPOS' ;
                Cart::where('user_id',Auth::user()->id)->delete();

                toastr()->success('Order Success');

                $data = [
                    'method'=> 'Credit Card',
                    'phone' => Auth::user()->phone,
                    'email' => Auth::user()->email,
                    'transactionId' => $transactionId,
                ];
                return view('user.payments.successPayment',compact('data'));
            }else{
                toastr()->error('Payment Failed!');
                return back();
            }
        }

    }
}
