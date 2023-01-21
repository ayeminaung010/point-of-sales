<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\User;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //account
    public function account(){
        return view('admin.profile.account');
    }

    //editPage
    public function editPage(){
        return view('admin.profile.edit');
    }

    //update
    public function update(Request $request,$id){
       $request->validate([
        'image' => 'mimes:jpg,png,jpeg,webp',
        'name' => 'required',
        'phone' => 'required',
        'gender' => 'required',
        'address' => 'required',
       ]);
       $admin =  User::find($id);
       $admin_oldImg = $admin->image;

       if($request->image){
        if($admin_oldImg !== null){
            Storage::delete('public/img/admin/'.$admin_oldImg);
        }

        $newImg = uniqid().'_'.$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/img/admin/',$newImg);
        User::where('id',$id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'image' => $newImg,
           ]);
       }
       User::where('id',$id)->update([
        'name' => $request->name,
        'phone' => $request->phone,
        'gender' => $request->gender,
        'address' => $request->address,
       ]);
       toastr()->success('Profile Updated Success');
       return redirect()->route('admin#account');
    }

    // password update
    public function updatePassword(AdminRequest $request){
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbPw = $user->password;
        if(Hash::check($request->oldPassword, $dbPw)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            if($request->newPassword === $request->confirmPassword){
                User::where('id',Auth::user()->id)->update($data);
                toastr()->success('Password Updated Success! Login Back Please...');
                Auth::Logout();
                return redirect()->route('loginPage');
            }
            toastr()->error('new password and confirm password must be same');
            return redirect()->route('admin#changePasswordPage');
        }
        toastr()->error('Password Does not Match');
        return redirect()->route('admin#changePasswordPage');

    }

    //admin List
    public function adminList(){
        $admins = User::where('role','admin')->when(request('search'),function($query){
            $query->where('users.name','like','%'.request('search').'%');
        })->orderBy('id','asc')->paginate(5);
        return view('admin.profile.listAdmin',compact('admins'));
    }

    //axios rolechange
    public function roleChange(Request $request){
        $result = User::select('role')->where('id',$request->userId)->update([
            'role' => $request->role
        ]);
        $responseSuccess = [
            'message' => 'Changes Successfull',
            'status' => 'success'
        ];
        $responseFail = [
            'message' => 'Changes Failed',
            'status' => 'Fail'
        ];
        if($result){
            return response()->json($responseSuccess,200);
        }else{
            return response()->json($responseFail,400);
        }
    }

    //user //lists
    public function list(){
        $users = User::where('role','user')->paginate(10);
        return view('admin.userList.list',compact('users'));
    }

}
