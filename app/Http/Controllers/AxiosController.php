<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Rating;
use App\Models\Product;
use App\Events\TestEvent;
use App\Events\FavEvent;
use App\Models\FavProducts;
use Illuminate\Http\Request;
use App\Notifications\InvoicePaid;
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
            event(new TestEvent('Successfully added'));
            return response()->json('success',200);
        }else{
            if($request->orderCount > 1){
                $alreadyCart = Cart::where('product_id',$request->productId)->where('user_id',Auth::user()->id)->first();
                $alreadyCart->qty = $alreadyCart->qty + $request->orderCount;
                $alreadyCart->update();
                event(new TestEvent('Successfully added'));

                return response()->json('success added new Qty',220);
            }
        }
        // event(new TestEvent($result));
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

    //increaseViewCount
    public function increaseViewCount(Request $request){
        $product  = Product::where('id',$request->productId)->first();
        $product->view_count = $product->view_count + 1;
        $product->update();
    }

    //review
    public function review(Request $request){
        $data = Rating::create([
            'rating_status' => $request->data['ratingCount'],
            'message' => $request->data['message'],
            'product_id' => $request->data['productId'],
            'user_id' => Auth::user()->id,
        ]);

        logger($data->user_id);
        $data->user_id = Auth::user()->name;
        return response()->json($data,200);
    }


    //addToFav
    public function addToFav(Request $request){
        $alreadyProducts = FavProducts::where('user_id',Auth::user()->id)->where('product_id',$request->params['productId'])->first();
        // logger($alreadyProducts);
        if($alreadyProducts){
            $result = $alreadyProducts->delete();
            event(new FavEvent($result));
            return response()->json(['data' => 'success removed' , 'event' => false],200);
        }else{
            $result = FavProducts::create([
                'product_id' => $request->params['productId'],
                'user_id' => Auth::user()->id
            ]);
            event(new FavEvent($result));
            return response()->json(['data' => 'success added' , 'event' => true],200);
        }
    }

    //removeFromFav
    public function removeFromFav(Request $request){
        // logger($request->all());
        $alreadyProducts = FavProducts::where('user_id',Auth::user()->id)->where('product_id',$request->params['productId'])->first();
        $alreadyProducts->delete();
        return response()->json(['data' => 'success removed' , 'event' => true],200);
    }
}
