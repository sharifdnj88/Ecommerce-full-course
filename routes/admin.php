<?php


use Illuminate\Support\Facades\Route;


Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');


Route::group(['namespace'=>'App\Http\Controllers\Admin', 'middleware'=>'is_admin'], function(){
    Route::get('/admin-home','AdminController@admin')->name('admin.home');
    Route::get('/admin-logout','AdminController@logout')->name('admin.logout');
    Route::get('/admin-profile','AdminController@profile')->name('admin.profile');
    Route::post('/admin-profile-password','AdminController@profilePasswordChange')->name('admin.password.update');

    // Product Route
    Route::group(['prefix'=>'product'], function(){
        Route::get('/','productController@index')->name('product.index');
        Route::get('/create','productController@create')->name('product.create');
        Route::post('/store','productController@store')->name('product.store');
        Route::delete('/delete/{id}','productController@destroy')->name('product.delete');
        Route::get('/edit/{id}','productController@edit')->name('product.edit');
        // Route::post('/update','CategoryController@update')->name('category.update');
        Route::get('/featured-deactive/{id}','productController@featuredDeactive');
        Route::get('/featured-active/{id}','productController@featuredActive');
        Route::get('/today-deal-deactive/{id}','productController@todaydealDeactive');
        Route::get('/today-deal-active/{id}','productController@todaydealActive');
        Route::get('/status-deactive/{id}','productController@statusDeactive');
        Route::get('/status-active/{id}','productController@statusActive');
    });

    //global route
	Route::get('/get-child-category/{id}','CategoryController@GetChildCategory');

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

    // Warehouse Category Route
    Route::group(['prefix'=>'warehouse'], function(){
        Route::get('/','warehouseController@index')->name('warehouse.index');
        Route::post('/store','warehouseController@store')->name('warehouse.store');
        Route::get('/delete/{id}','warehouseController@destroy')->name('warehouse.delete');
        Route::get('/edit/{id}','warehouseController@edit');
        Route::post('/update','warehouseController@update')->name('warehouse.update');
    });

    //Coupon Routes
	Route::group(['prefix'=>'coupon'], function(){
		Route::get('/','CouponController@index')->name('coupon.index');
		Route::post('/store','CouponController@store')->name('coupon.store');
		Route::delete('/delete/{id}','CouponController@destroy')->name('coupon.delete');
		Route::get('/edit/{id}','CouponController@edit');
		Route::post('/update','CouponController@update')->name('coupon.update');
	});
    
    //campaign Routes
	Route::group(['prefix'=>'campaign'], function(){
		Route::get('/','CampaignController@index')->name('campaign.index');
		Route::post('/store','CampaignController@store')->name('campaign.store');
		Route::delete('/delete/{id}','CampaignController@destroy')->name('campaign.delete');
		Route::get('/edit/{id}','CampaignController@edit');
		Route::post('/update','CampaignController@update')->name('campaign.update');
	});

    //Coupon Routes
	Route::group(['prefix'=>'pickup-point'], function(){
		Route::get('/','PickupController@index')->name('pickup.point.index');
		Route::post('/store','PickupController@store')->name('pickup.point.store');
		Route::delete('/delete/{id}','PickupController@destroy')->name('pickup.point.delete');
		Route::get('/edit/{id}','PickupController@edit');
		Route::post('/update','PickupController@update')->name('pickup.point.update');
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
        // Setting Website Route
        Route::group(['prefix'=>'website'], function(){
            Route::get('/','SettingController@websiteIndex')->name('setting.website.index');
            Route::post('/store','SettingController@websiteStore')->name('setting.website.store');
            Route::get('/delete/{id}','SettingController@websiteDestroy')->name('setting.website.delete');
            Route::get('/edit/{id}','SettingController@websiteEdit');
            Route::post('/update','SettingController@websiteUpdate')->name('setting.website.update');
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
