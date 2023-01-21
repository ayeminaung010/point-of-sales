<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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
    Route::get('/home', [UserController::class,'home'])->name('user#home');

    Route::get('/product/detail/{id}',[UserController::class,'detail'])->name('user#productDetail');

    // axios
    Route::get('/filter/category',[UserController::class,'filterCategory'])->name('user#filterCategory'); //axios use
    Route::get('/filter/allCategories',[UserController::class,'allCategories'])->name('user#filterallCategories'); //axios use
    Route::get('/sort/products',[UserController::class,'sorting'])->name('user#sortingProducts'); //axios use
    //axios end

    Route::get('/profile',[UserController::class,'profile'])->name('user#profile');
    Route::get('/profile/edit',[UserController::class,'editPage'])->name('user#editPage');
    Route::post('/profile/update',[UserController::class,'profileUpdate'])->name('user#profileupdate');

    Route::get('/passwordChange',[UserController::class,'passwordChangePage'])->name('user#passwordChangePage');
    Route::post('/passwordChange/update',[UserController::class,'passwordChangeUpdate'])->name('user#passwordChangeUpdate');

    Route::get('/contact',[UserController::class,'contact'])->name('user#contact');

    Route::get('cart',[CartController::class,'cartItem'])->name('user#cart');
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
        Route::get('/detail/{id}',[ProductController::class,'detail'])->name('admin#productDetail');
    });

    //order
    Route::prefix('order')->group(function(){
        Route::get('/list',[OrderController::class,'list'])->name('admin#orderList');
    });

    //profile
    Route::prefix('profile')->group(function(){
        Route::get('/account',[AdminController::class,'account'])->name('admin#account');
        Route::get('/editPage',[AdminController::class,'editPage'])->name('admin#editPage');
        Route::post('/update/{id}',[AdminController::class,'update'])->name('admin#update');
        // Route::get('/changePassword',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
        Route::view('/passwordChange','admin.profile.passwordChange')->name('admin#changePasswordPage');
        Route::post('/passwordUpdate',[AdminController::class,'updatePassword'])->name('admin#updatePassword');
        Route::get('/adminList',[AdminController::class,'adminList'])->name('admin#adminList');
        Route::get('/ajax/roleChange',[AdminController::class,'roleChange'])->name('admin#roleChange');
    });

    Route::prefix('userList')->group(function(){
        Route::get('/lists',[AdminController::class,'list'])->name('admin#userList');
    });


});


