<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\LoginController;



Route::get('/customer/signup',[LoginController::class,'signUpForm'])->name('customer.signup');
Route::post('/customer/signup',[LoginController::class,'signup'])->name('customer.signup');

Route::get('/customer/login',[LoginController::class,'login'])->name('customer.login');
Route::post('/customer/login',[LoginController::class,'loginData'])->name('customer.login');

Route::get('/customer/forget-password',[LoginController::class,'forgetPasswordForm'])->name('customer.forgetPassword');
Route::post('/customer/forget-password',[LoginController::class,'forgetPasswordSend'])->name('customer.forgetPassword');
Route::post('/customer/update/password',[LoginController::class,'updatePassword'])->name('customerupdatePassword');
Route::get('/customer/password/reset/{email}',[LoginController::class,'resetLinkPassword'])->name('customerpassword.link');

Route::get('/customer/update-profile',[LoginController::class,'customerProfile'])->name('customer.updateProfile');
Route::post('/customer/update-profile',[LoginController::class,'customerProfileUpdate'])->name('customer.updateProfile');
Route::get('/customer/dashboard',[LoginController::class,'customerDashboard'])->name('customer.dashboard')->middleware('customerlogin');

Route::post('/check-validity',[LoginController::class,'checkValidity'])->name('customer.chcekvaliditi');

Route::post('/book/login',[LoginController::class,'bookLoginForm'])->name('customer.booklogin');

Route::get('/customer/book/login',[LoginController::class,'bookWithLogin'])->name('customer.bookloginData');

Route::get('/customer/logout',function()
{
    Auth::guard('customer')->logout();
    return redirect()->route('customer.login');
})->name('customer.logout');
