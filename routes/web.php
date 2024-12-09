<?php

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/login',function(){
    return redirect()->to('/');
})->name('login');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/customer-logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('customer.logout');

Route::group(['namespace'=>'App\Http\Controllers\Front'], function(){
    Route::get('/', 'FrontendController@home');
    Route::get('/product-details/{slug}', 'FrontendController@productDetails')->name('product.details');
    // product-quick-view
    Route::get('/product-quick-view/{id}', 'FrontendController@productQuickView');

    // Cart All Route
    Route::get('/all-cart','cartController@AllCart')->name('all.cart'); //ajax request for subtotal
    Route::post('/add-to-cart', 'cartController@addToCart')->name('add.to.cart');
    Route::get('/cart', 'cartController@myCart')->name('cart');
    Route::delete('delete-from-cart','cartController@deletefromcart');

    // Review Controller
    Route::post('/review-store', 'ReviewController@store')->name('review.store');  

    // Wishlist- Controller
    Route::post('/add-wishlist/{id}', 'WishlistController@addWishlist')->name('add.wishlist');  
    Route::get('/all-wishlist','WishlistController@AllWishlist')->name('all.wishlist'); //ajax request for subtotal

   

});

Route::get('cart-destroy', function(){
    Cart::destroy();
});