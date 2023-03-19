<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AxiosController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecycleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Events\TestEvent;


Route::get('/',[UserController::class,'home']);

Route::get('/loginPage', function () {

    return view('login');
})->name('loginPage');

Route::get('/registerPage', function () {
    return view('register');
})->name('registerPage');

Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');

// axios
Route::get('/filter/category',[UserController::class,'filterCategory'])->name('filterCategory'); //axios use
Route::get('/filter/allCategories',[UserController::class,'allCategories'])->name('filterAllCategories'); //axios use
Route::get('/sort/products',[UserController::class,'sorting'])->name('sortingProducts'); //axios use

// user
Route::prefix('user')->middleware('user_auth')->group(function () {
    Route::get('/home', [UserController::class,'home'])->name('user#home');

    Route::get('/product/detail/{id}',[UserController::class,'detail'])->name('user#productDetail');
    // axios
    Route::get('/filter/category',[UserController::class,'filterCategory'])->name('user#filterCategory'); //axios use
    Route::get('/filter/allCategories',[UserController::class,'allCategories'])->name('user#filterAllCategories'); //axios use
    Route::get('/sort/products',[UserController::class,'sorting'])->name('user#sortingProducts'); //axios use

    Route::get('/addToCart',[AxiosController::class,'addToCart'])->name('user#addToCart'); //axios use
    Route::get('/addCountCart',[AxiosController::class,'addCountCart'])->name('user#addCountCart'); //axios use
    Route::get('/removeFromCart',[AxiosController::class,'removeFromCart'])->name('user#removeFromCart'); //axios use
    Route::get('/countUpdate',[AxiosController::class,'countUpdate'])->name('user#countUpdate'); //axios use
    Route::get('/clearCart',[AxiosController::class,'clearCart'])->name('user#clearCart'); //axios use

    Route::get('/viewCount',[AxiosController::class,'increaseViewCount'])->name('user#viewCount');

    Route::post('/review',[AxiosController::class,'review'])->name('user#review');
    Route::post('/addToFav',[AxiosController::class,'addToFav'])->name('user#addToFav');
    Route::post('/removeFromFav',[AxiosController::class,'removeFromFav'])->name('user#removeFromFav');
    //axios end
    Route::get('/fav-lists',[UserController::class,'favLists'])->name('user#favLists');

    Route::get('/profile',[UserController::class,'profile'])->name('user#profile');
    Route::get('/profile/edit',[UserController::class,'editPage'])->name('user#editPage');
    Route::post('/profile/update',[UserController::class,'profileUpdate'])->name('user#profileupdate');

    Route::get('/passwordChange',[UserController::class,'passwordChangePage'])->name('user#passwordChangePage');
    Route::post('/passwordChange/update',[UserController::class,'passwordChangeUpdate'])->name('user#passwordChangeUpdate');

    Route::get('/contact',[ContactController::class,'contact'])->name('user#contact');
    Route::post('/contact/send',[ContactController::class,'sendToAdmin'])->name('user#sendToAdmin');

    Route::get('cart',[CartController::class,'cartItem'])->name('user#cart');


    Route::get('payment',[CartController::class,'payment'])->name('user#payment'); // axios
    Route::post('payment/verify',[CartController::class,'verify'])->name('user#paymentVerify');
    Route::post('paymentWallet/verify',[CartController::class,'verifyWallet'])->name('user#verifyWallet');
    // Route::view('payment/success', 'user.payments.successPayment');

    Route::get('history/{id}',[CartController::class,'orderHistory'])->name('user#orderHistory');
    Route::get('products/{id}',[CartController::class,'orderProducts'])->name('user#orderProducts');
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
        Route::get('/orders-details/{id}',[OrderController::class,'userOrderLists'])->name('admin#userOrderLists');
        Route::get('statusChange',[OrderController::class,'statusChange'])->name('admin#statusChange');
        Route::get('filterOrder',[OrderController::class,'filterOrder'])->name('admin#filterOrder');
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
        Route::get('/axios/roleChange',[AdminController::class,'roleChange'])->name('admin#roleChange'); //axios use
    });

    Route::prefix('userList')->group(function(){
        Route::get('/lists',[AdminController::class,'list'])->name('admin#userList');
        Route::get('/roleChange',[AdminController::class,'userRole'])->name('admin#userRole'); //axios
        Route::get('/delete/{id}',[AdminController::class,'deleteUser'])->name('admin#deleteUserAccount');
        Route::get('/detail/{id}',[AdminController::class,'detailUser'])->name('admin#detailUserAccount');
        Route::get('/edit/{id}',[AdminController::class,'editUser'])->name('admin#editUserAccount');
        Route::post('/update/{id}',[AdminController::class,'updateUser'])->name('admin#updateUserAccount');
        Route::get('/changePassword/{id}',[AdminController::class,'changePasswordUser'])->name('admin#changePasswordUser');
        Route::post('/updatePassword/{id}',[AdminController::class,'UpdatePasswordUser'])->name('admin#UpdatePasswordUser');
    });

    Route::prefix('contact')->group(function(){
        Route::get('/messsage',[ContactController::class,'message'])->name('admin#contactMessage');
        Route::get('/deleteMessage/{id}',[ContactController::class,'deleteMessage'])->name('admin#deleteMessage');
        Route::get('/details/{id}',[ContactController::class,'contactDetails'])->name('admin#contactDetails');
        Route::get('/details/{id}',[ContactController::class,'contactDetails'])->name('admin#contactDetails');
        Route::get('/deleteAll',[ContactController::class,'deleteAllmessages'])->name('admin#deleteAllmessages');
    });

    Route::prefix('recycle')->group(function(){
        Route::get('/trash',[RecycleController::class,'list'])->name('admin#trashLists');
        Route::get('/restore/{id}',[RecycleController::class,'restore'])->name('admin#restoreTrash');
        Route::get('/deletePermanently/{id}',[RecycleController::class,'deletePermanently'])->name('admin#deletePermanently');
    });


});


