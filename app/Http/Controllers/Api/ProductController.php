<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    //index
    public function index(){
        $products = Product::orderBy('name')
                    ->select('products.*','categories.name as category_name')
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->get();
        return ResponseHelper::success(ProductResource::collection($products));
    }


    //sigleProduct
    public function sigleProduct($id){
        $product = Product::where('id',$id)->first();
        return ResponseHelper::success($product);
    }
}
