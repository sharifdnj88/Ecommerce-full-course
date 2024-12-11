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

    // Category Wise Product
    Route::get('/category-wise-product/{id}', 'FrontendController@categoryWiseProduct')->name('categorywise.product');
    Route::get('/subcategory-wise-product/{id}', 'FrontendController@SubcategoryWiseProduct')->name('subcategorywise.product');
    Route::get('/childcategory-wise-product/{id}', 'FrontendController@ChildcategoryWiseProduct')->name('childcategorywise.product');
    Route::get('/brand-wise-product/{id}', 'FrontendController@BrandWiseProduct')->name('brandwise.product');


    // product-quick-view
    Route::get('/product-quick-view/{id}', 'FrontendController@productQuickView');

    // Cart All Route
    Route::get('/all-cart','cartController@AllCart')->name('all.cart'); //ajax request for subtotal    

    Route::get('/cart', 'cartController@myCart')->name('cart');
    Route::post('/add-to-cart', 'cartController@addToCart')->name('add.to.cart');
    Route::post('update-cart-qty','cartController@updatetocart');
    Route::post('update-cart-color','cartController@updateCartColor');
    Route::get('update-cart-size/{rowId}/{size}','cartController@updateCartSize');
    Route::delete('delete-from-cart','cartController@deletefromcart');
    Route::get('all-cart-item-empty','cartController@cartEmpty')->name('all.cart.item.destroy');

    // Review Controller
    Route::post('/review-store', 'ReviewController@store')->name('review.store');  

    // Wishlist- Controller
    Route::get('/wishlist','WishlistController@WishlistPage')->name('wishlist');
    Route::post('/add-wishlist/{id}', 'WishlistController@addWishlist')->name('add.wishlist');  
    Route::get('/all-wishlist','WishlistController@AllWishlist')->name('all.wishlist'); //ajax request for subtotal
    Route::delete('delete-from-wishlist','WishlistController@deleteFromWishlist');
    Route::get('/all-wishlist-item-destroy','WishlistController@AllWishlistDestroy')->name('all.wishlist.item.destroy');
  

});

Route::get('cart-destroy', function(){
    Cart::destroy();
});