<?php


use Illuminate\Support\Facades\Route;


Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');


Route::group(['namespace'=>'App\Http\Controllers\Admin', 'middleware'=>'is_admin'], function(){
    Route::get('/admin-home','AdminController@admin')->name('admin.home');
    Route::get('/admin-logout','AdminController@logout')->name('admin.logout');
    Route::get('/admin-profile','AdminController@profile')->name('admin.profile');
    Route::post('/admin-profile-password','AdminController@profilePasswordChange')->name('admin.password.update');

    // Category Route
    Route::group(['prefix'=>'category'], function(){
        Route::get('/','CategoryController@index')->name('category.index');
        Route::post('/store','CategoryController@store')->name('category.store');
        Route::get('/delete/{id}','CategoryController@destroy')->name('category.delete');
        Route::get('/edit/{id}','CategoryController@edit');
        Route::post('/update','CategoryController@update')->name('category.update');
    });

    // Subcategory Route
    Route::group(['prefix'=>'subcategory'], function(){
        Route::get('/','SubcategoryController@index')->name('subcategory.index');
        Route::post('/store','SubcategoryController@store')->name('subcategory.store');
        Route::get('/delete/{id}','SubcategoryController@destroy')->name('subcategory.delete');
        Route::get('/edit/{id}','SubcategoryController@edit');
        Route::post('/update','SubcategoryController@update')->name('subcategory.update');
    });

    // Childcategory Route
    Route::group(['prefix'=>'childcategory'], function(){
        Route::get('/','ChildcategoryController@index')->name('childcategory.index');
        Route::post('/store','ChildcategoryController@store')->name('childcategory.store');
        Route::get('/delete/{id}','ChildcategoryController@destroy')->name('childcategory.delete');
        Route::get('/edit/{id}','ChildcategoryController@edit');
        Route::post('/update','ChildcategoryController@update')->name('childcategory.update');
    });

    // Brand Category Route
    Route::group(['prefix'=>'brand'], function(){
        Route::get('/','BrandController@index')->name('brand.index');
        Route::post('/store','BrandController@store')->name('brand.store');
        Route::get('/delete/{id}','BrandController@destroy')->name('brand.delete');
        Route::get('/edit/{id}','BrandController@edit');
        Route::post('/update','BrandController@update')->name('brand.update');
    });

    // Setting Route
    Route::group(['prefix'=>'setting'], function(){        
        // Setting SEO Route
        Route::group(['prefix'=>'seo'], function(){
            Route::get('/','SettingController@seoIndex')->name('setting.seo.index');
            Route::post('/update/{id}','SettingController@seoUpdate')->name('setting.seo.update');
        });
        // Setting SEO Route
        Route::group(['prefix'=>'smtp'], function(){
            Route::get('/','SettingController@smtpIndex')->name('setting.smtp.index');
            Route::post('/update/{id}','SettingController@smtpUpdate')->name('setting.smtp.update');
        });
        // Setting Page Route
        Route::group(['prefix'=>'page'], function(){
            Route::get('/','SettingController@pageIndex')->name('setting.page.index');
            Route::post('/store','SettingController@pageStore')->name('setting.page.store');
            Route::get('/delete/{id}','SettingController@pageDestroy')->name('setting.page.delete');
            Route::get('/edit/{id}','SettingController@PageEdit');
            Route::post('/update','SettingController@pageUpdate')->name('setting.page.update');
        });


    });



});
