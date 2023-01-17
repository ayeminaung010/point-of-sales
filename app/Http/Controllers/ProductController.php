<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    // list
    public function list(){
        return view('admin.products.list');
    }

    //create page
    public function createPage(){
        return view('admin.products.create');
    }
}
