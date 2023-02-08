<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;

class ProfileController extends Controller
{
    //profile
    public function profile(){
        $user = auth()->guard()->user();

        $data = new ProfileResource($user);
        return ResponseHelper::success($data);
    }

    //logout
    public function logout(){
        auth()->user()->token()->revoke();
        return ResponseHelper::success([],'SuccessFully Logout');
    }
}
