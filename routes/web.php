<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('login');
});

Route::get('/loginPage', function () {
    return view('login');
})->name('loginPage');

Route::get('/registerPage', function () {
    return view('register');
})->name('registerPage');

Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');

// user
Route::prefix('user')->middleware('user_auth')->group(function () {
    Route::get('/home', function () {
        return view('user.home.home');
    })->name('user#home');
});



// admin
Route::prefix('admin')->middleware('admin_auth')->group(function () {
    Route::get('/categoryList',[CategoryController::class,'list'])->name('admin#categoryList');

    // category
    Route::prefix('category')->group(function(){
        Route::get('/createPage',[CategoryController::class,'createPage'])->name('admin#categoryCreatePage');
        Route::post('/create',[CategoryController::class,'create'])->name('admin#categoryCreate');
        Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('admin#categoryDelete');
        Route::get('/edit/{id}',[CategoryController::class,'editPage'])->name('admin#categoryEdit');
        Route::post('/update/{id}',[CategoryController::class,'update'])->name('admin#categoryUpdate');
    });

    //products
    Route::prefix('product')->group(function(){
        Route::get('/list',[ProductController::class,'list'])->name('admin#productList');
        Route::get('/createPage',[ProductController::class,'createPage'])->name('admin#productCreatePage');
        Route::post('/create',[ProductController::class,'create'])->name('admin#productCreate');
        Route::get('/delete/{id}',[ProductController::class,'delete'])->name('admin#productDelete');
        Route::get('/edit/{id}',[ProductController::class,'editPage'])->name('admin#productEditPage');
        Route::post('/update',[ProductController::class,'update'])->name('admin#productUpdate');
    });


});