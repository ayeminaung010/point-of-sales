<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\FuncCall;

class UserController extends Controller
{
    //home
    public function home() {
        $products = Product::get();
        $categories = Category::get();
        $carts = Cart::where('user_id',Auth::user()->id)->get();
        return view('user.home.home',compact('products','categories','carts'));
    }

    //details product
    public function detail($id){
        $product = Product::where('id',$id)->first();
        $products = Product::where('id','!=',$id)->get();

        return view('user.products.detail',compact('product','products'));
    }


    //filter category products axios
    public function filterCategory(Request $request){
        $products = Product::whereIn('category_id',$request->categoryId)->get();
        return response()->json($products,200);
    }

    //allCategories axios
    public function allCategories(Request $request){
        $products = Product::whereIn('category_id',$request->categoryId)->get();
        return response()->json($products,200);
    }

    //sorting axios
    public function sorting(Request $request){
        logger($request->sortType);
        if($request->sortType === 'lastestSort'){
            $data = Product::orderBy('created_at','desc')->get();
        }
        return response()->json($data,200);
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
    public function profileUpdate(UserRequest $request){
        $user = User::where('id',Auth::user()->id)->first();
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

    //passwordChangeUpdate
    public function passwordChangeUpdate(Request $request){
        $request->validate([
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|same:newPassword|min:6',
        ]);
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $userOldPw = $user->password;
        if(Hash::check($request->oldPassword, $userOldPw)){
            $newData = [
                'password' => Hash::make($request->newPassword),
            ];
            if($request->newPassword === $request->confirmPassword){
                User::where('id',Auth::user()->id)->update($newData);
                toastr()->success('Password Updated Success! Login Back Please...');
                Auth::logout();
                return redirect()->route('loginPage');
            }
            toastr()->error('new password and confirm password must be same');
            return back();
        }
        toastr()->error('Password Does not Match');
        return back();
    }


}
