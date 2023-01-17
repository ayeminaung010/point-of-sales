<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    //list
    public function list(){
        $categories = Category::get();
        return view('admin.category.categoryList',compact('categories'));
    }

    //createPage
    public function createPage(){
        return view('admin.category.create');
    }

    // create
    public function create(CategoryRequest $request){
        $category = new Category();
        $category->name = $request->categoryName;
        $category->save();
        return redirect()->route('admin#categoryList');
    }

    //delete
    public function delete($id){
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('admin#categoryList')->with('deleteSuccess');
    }

    // edit page
    public function editPage($id){
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    // update
    public function update(CategoryRequest $request, $id){
        dd($id);
        $category = Category::find($id);
        $category->name = $request->categoryName;
        // Category::update();
    }


}
