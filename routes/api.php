<?php

use App\Models\Buyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\SendOtpController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\Auth\VerifyOtpController;

use App\Helpers\CommonHelper;
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

Route::post('/mobile-register', [RegisterController::class, 'mobileRegister']);
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/send-otp', [SendOtpController::class, 'send']);
Route::post('/verify-otp', [VerifyOtpController::class, 'verifyOtp']);

Route::get('/restaurant/listing', [RestaurantController::class, 'restaurant_listing']);
Route::get('/restaurant/detail', [RestaurantController::class, 'restaurant_get']);

Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::get('/logout', [LoginController::class,'logout']);
    /*restaurant*/
    Route::post('/restaurant/detail', [RestaurantController::class, 'restaurant_post']);

});
