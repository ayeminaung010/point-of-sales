<?php


use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register',[ApiController::class,'register']);
Route::post('login',[ApiController::class,'login']);

//login access routes
Route::middleware('auth:api')->group(function (){
    Route::get('profile',[ProfileController::class,'profile']);

    Route::post('logout',[ProfileController::class,'logout']);
});

//category
Route::get('categories',[CategoryController::class,'index']);
Route::get('category/{id}',[CategoryController::class,'singleCategory']);


//products
Route::get('products',[ProductController::class,'index']);
Route::get('product/{id}',[ProductController::class,'sigleProduct']);
