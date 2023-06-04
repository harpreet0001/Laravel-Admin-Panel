<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//users routes
Route::get('/', function () {return view('welcome');});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//admin routes
Route::group([
               'prefix'     => 'admins',
               'as'         => 'admin.',
               'namespace'  => 'App\Http\Controllers\Admin',
               'middleware' => ['auth','AdminAuth']
            ],
    function(){
    
    Route::get('/', function () {return view('admin.pages.dashboard');})->name('index'); 
    Route::resource('users',UserController::class);
    Route::resource('vendors',VendorController::class);
    Route::resource('category',CategoryController::class);
    Route::resource('product',ProductController::class);
    Route::resource('sliders',SliderController::class);
    Route::get('product/{id}/images',[App\Http\Controllers\Admin\ProductController::class,'product_images'])->name('product.images');
    Route::delete('product/{product_id}/images/{image_id}',[App\Http\Controllers\Admin\ProductController::class,'product_images_delete'])->name('product.images.destroy');
    Route::post('users/changeActiveStatus',[App\Http\Controllers\Admin\UserController::class,'change_active_status'])->name('users.change_active_status');
    
    //Dropzone
    Route::get('slider-images','SliderController@slider_images')->name('slider-images');
    //** admin change password **//
    Route::group(['as' => 'settings.'],function(){

        Route::get('/change-password','SettingController@changePassword')->name('change-password');
        Route::post('/reset-password','SettingController@resetPassword')->name('reset-password');
        Route::match(['get','post'],'/slider','SettingController@slider')->name('slider');

    });

});

Route::group([
    'prefix'     => 'admins',
    'as'         => 'admin.',
    'namespace'  => 'App\Http\Controllers',
    'middleware' => ['auth','AdminAuth']
 ],
function(){
    /*businness routes*/
    Route::group(['namespace' => 'Business'],function(){
        Route::resource('business', 'BusinessController');
        Route::get('business_datatable', 'BusinessController@business_datatable')->name('business.datatable');
        Route::post('business/change-profile-verification-status/{business}','BusinessController@change_profile_verification_status')->name('business.change-profile-verification-status');     
    
    });
});


Route::get('/php',function() {

    phpinfo();
});




