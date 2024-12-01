<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/login',function(){
    return redirect()->to('/');
})->name('login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/customer-logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('customer.logout');

Route::group(['namespace'=>'App\Http\Controllers\Front'], function(){
    Route::get('/', 'FrontendController@home');
    Route::get('/product-details/{slug}', 'FrontendController@productDetails')->name('product.details');

    // Review Controller
    Route::post('/review-store', 'ReviewController@store')->name('review.store');

});

