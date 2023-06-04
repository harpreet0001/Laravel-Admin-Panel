<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\FrontendBusinessManageController;


/*----------------------------------------------------------------------------------------------------------------------------
                                                     ADMIN PANEL ROUTES
----------------------------------------------------------------------------------------------------------------------------*/
Route::get('/', [AdminDashboardController::class,'adminIndex'])->name('admin.home');
//admin settings
Route::get('/settings',[AdminDashboardController::class,'admin_settings'])->name('admin.profile.settings');
Route::get('/profile-update',[AdminDashboardController::class,'admin_profile'])->name('admin.profile.update');
Route::post('/profile-update',[AdminDashboardController::class,'admin_profile_update']);
Route::get('/password-change',[AdminDashboardController::class,'admin_password'])->name('admin.password.change');
Route::post('/password-change',[AdminDashboardController::class,'admin_password_chagne']);


 //Frontend business management    
 Route::get('/frontend/all-business',[FrontendBusinessManageController::class,'all_business'])->name('admin.all.frontend.business');
 Route::post('/frontend/change-business-status/{id}',[FrontendBusinessManageController::class,'businessStatus'])->name('admin.frontend.business.status');
 Route::get('/frontend/business-datatable', [FrontendBusinessManageController::class,'business_datatable'])->name('admin.all.frontend.business.datatable');
 Route::get('/frontend/business-profile-view/{id}',[FrontendBusinessManageController::class,'businessProfileView'])->name('admin.frontend.business.profile.view');
 Route::post('/frontend/verify-business-profile/{id}',[FrontendBusinessManageController::class,'businessVerify'])->name('admin.frontend.business.profile.verify');

 //Frontend customer management  

 Route::get('/frontend/all-customer',[FrontendCustomerManageController::class,'all_customer'])->name('admin.all.frontend.customer');
 Route::post('/frontend/change-customer-status/{id}',[FrontendCustomerManageController::class,'customerStatus'])->name('admin.frontend.customer.status');
 Route::get('/frontend/customer-datatable', [FrontendCustomerManageController::class,'customer_datatable'])->name('admin.all.frontend.customer.datatable');
 Route::get('/frontend/customer-profile-view/{id}',[FrontendCustomerManageController::class,'customerProfileView'])->name('admin.frontend.customer.profile.view');
 Route::post('/frontend/verify-customer-profile/{id}',[FrontendCustomerManageController::class,'customerVerify'])->name('admin.frontend.customer.profile.verify');
