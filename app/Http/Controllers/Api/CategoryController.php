<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    //categories index
    public function index(){
        $categories = Category::orderBy('name')->get();
        return ResponseHelper::success(CategoryResource::collection($categories));
    }

    //singleCategory
    public function singleCategory($id){
        $category   = Category::where('id',$id)->first();
        return ResponseHelper::success($category);
    }
}
