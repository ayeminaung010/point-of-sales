<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //home
    public function home() {
        $products = Product::get();
        $categories = Category::get();
        return view('user.home.home',compact('products','categories'));
    }


    //filter category products
    public function filterCategory(Request $request){
        $products = Product::whereIn('category_id',$request->categoryId)->get();
        return response()->json($products,200);
    }
}
