<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\FuncCall;

class UserController extends Controller
{
    //home
    public function home() {
        $products = Product::get();
        $categories = Category::get();
        return view('user.home.home',compact('products','categories'));
    }

    //details product
    public function detail($id){
        $product = Product::where('id',$id)->first();
        $products = Product::where('id','!=',$id)->get();
        return view('user.products.detail',compact('product','products'));
    }


    //filter category products
    public function filterCategory(Request $request){
        $products = Product::whereIn('category_id',$request->categoryId)->get();
        return response()->json($products,200);
    }

    //allCategories
    public function allCategories(Request $request){
        $products = Product::whereIn('category_id',$request->categoryId)->get();
        return response()->json($products,200);
    }

    //profile
    public function profile(){

        return view('user.profile.detail');
    }

    //editPage
    public function editPage(){
        return view('user.profile.edit');
    }

    //update
    public function update(UserRequest $request,$id){
        $user = User::where('id',$id)->first();
        if($request->image){
            $oldImg = $user->image;
            if($oldImg){
                Storage::delete('img/user/'.$oldImg);
            }
            $imgName = uniqid().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/img/user/',$imgName);
            $user->image = $imgName;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            $user->address = $request->address;
            $user->save();
            toastr()->success('Profile Updated Success');
            return redirect()->route('user#profile');
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->save();
        toastr()->success('Profile Updated Success');
        return redirect()->route('user#profile');
    }

    //passwordChangePage
    public function passwordChangePage(){
        return view('user.profile.passwordChange');
    }

    //contact
    public function contact(){
        return view('user.contact.contact');
    }
}
