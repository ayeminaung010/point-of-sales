<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;


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
        $result =  $category->save();
        if(!$result){
            toastr()->error('Something wrong error 303');
        }else{
            toastr()->success('Product Created Success');
        }
        return redirect()->route('admin#categoryList');
    }

    //delete
    public function delete($id){
        $category = Category::find($id);
        $category->delete();
        $results = Category::where('id', '>', $id)
                    ->orderBy('id', 'asc')
                    ->get();

        foreach ($results as $row) {
                Category::where('id', $row->id)
                ->update(['id' => $row->id - 1]);
        }
        return redirect()->route('admin#categoryList')->with('deleteSuccess');
    }

    // edit page
    public function editPage($id){
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    // update
    public function update(CategoryRequest $request, $id){
        $category = Category::find($id);
        $category->name = $request->categoryName;
        $category->update();
        return redirect()->route('admin#categoryList')->with(['UpdateSuccess'=> 'Updated Successfully']);
    }


}
