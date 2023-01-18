<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // list
    public function list(){
        $products = Product::get();
        $category = $products[0]->category_id;
        $products = Product::with('category')
                    ->orderBy('updated_at','desc')->paginate(3);
        return view('admin.products.list',compact('products'));
    }

    //create page
    public function createPage(){
        $categories =  Category::select('id','name')->get();
        return view('admin.products.create',compact('categories'));
    }

    //create
    public function create(ProductRequest $request){
        $data = $this->requestProductData($request);
        $imgName = uniqid().'_'.$request->file('productImage')->getClientOriginalName();
        $request->file('productImage')->storeAs('public/img',$imgName);
        $data['image'] = $imgName;
        $result = Product::create($data);
        if(!$result){
            toastr()->error('Something wrong error 303');
        }else{
            toastr()->success('Product Created Success');
        }
        return redirect()->route('admin#productList');
    }

    //editPage
    public function editPage($id){
        $products = Product::find($id);
        $categories = Category::select('id','name')->get();
        return view('admin.products.edit',compact('products','categories'));
    }

    //update
    public function update(ProductRequest $request){
        $data = $this->requestProductData($request);
        if($request->hasFile('productImage')){
            $oldImg = Product::where('id',$request->productId)->first();
            $oldImg = $oldImg->image;
            if($oldImg !== null){
                Storage::delete('public/img/'.$oldImg);
            }

            $imgName = uniqid().'_'.$request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->storeAs('public/img',$imgName);
            $data['image'] = $imgName;
        }
        // dd($data);
        $result = Product::where('id',$request->productId)->update($data);
        $this->alert($result);
        return redirect()->route('admin#productList');
    }

    //delete
    public function delete($id){
        $products = Product::find($id);
        $result =  $products->delete();
        if(!$result){
            toastr()->error('Something wrong error 303');
        }else{
            toastr()->success('Product Deleted Success');
        }
        return redirect()->route('admin#productList');
    }

    //product request data
    private function requestProductData($request){
        return[
            'name' => $request->productName,
            'category_id' => $request->productCategory,
            'description' => $request->productDescription,
            'waiting_time' => $request->productWaitingTime,
            'price' => $request->productPrice,
        ];
    }

    public function alert($result){
        if(!$result){
            toastr()->error('Something wrong error 303');
        }else{
            toastr()->success('Product Created Success');
        }
    }
}
