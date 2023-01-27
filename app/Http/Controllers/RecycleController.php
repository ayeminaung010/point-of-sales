<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RecycleController extends Controller
{
    //list
    public function list(){
        $trashUsers = User::onlyTrashed()->paginate(10);
        return view('admin.recycle.trash',compact('trashUsers'));
    }

    //restore
    public function restore($id){
        $restoreUser = User::onlyTrashed()->find($id);
        $restoreUser->restore();
        toastr()->success('User Restored Success...');
        return back();
    }

    //deletePermanently
    public function deletePermanently($id){
        $deleteUser = User::onlyTrashed()->find($id);
        $deleteUser->forceDelete();
        toastr()->success('User Deleted Permanently...');
        return back();
    }
}
