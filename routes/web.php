<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['namespace'=>'App\Http\Controllers\Front'], function(){
    Route::get('/', 'FrontendController@home');
    Route::get('/product-details/{slug}', 'FrontendController@productDetails')->name('product.details');
});

