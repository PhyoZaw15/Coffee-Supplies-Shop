<?php

use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::group([ 'namespace' => 'App\Http\Controllers\Frontend' ], function(){

    Route::get('/', 'HomeController@index')->name('home');

    // User Auth
    Route::get('/login', 'AuthController@goToLogin')->name('user.login');
    Route::post('/login', 'AuthController@login');

    Route::group(['middleware' => 'user_auth'], function() {
        // Products
        Route::get('/products', 'ProductController@index')->name('frontend.products');

        // Carts
        Route::post('/carts/add', 'CartController@addToCart')->name('cart.add');
        Route::get('/carts', 'CartController@goToCheckout')->name('cart');
        Route::get('/carts/remove-item/{product_id}', 'CartController@removeFromCart');
        Route::get('/carts/add-qty/{product_id}', 'CartController@addQuantity');
        Route::get('/carts/reduce-qty/{product_id}', 'CartController@reduceQuantity');

        // Checkout
        Route::post('/checkout', 'CheckoutController@checkout')->name('checkout');
        Route::post('/checkout-ajax', 'CheckoutController@checkoutAjax')->name('checkout.ajax');
        Route::get('/order-details/{order_id}', 'CheckoutController@orderDetails')->name('order.details');

        // Subscribe
        Route::post('/subscribe', 'SubscriptionController@subscribe')->name('subscribe');

        // logout
        Route::post('/logout', 'AuthController@logout')->name('users.logout');
    });

});


// Admin Routes
Route::group(['prefix' => 'admin'], function(){
    Auth::routes( ['register' => false] );
});

Route::group(['middleware' => 'auth'], function(){

    Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin'], function()
    {
        // Roles
        Route::resource('roles', 'RoleController');

        // Admins
        Route::resource('admin-accounts', 'AdminController');

        // Users
        Route::resource('users', 'UserController');

        // Category
        Route::resource('categories', 'CategoryController');
        Route::get('categories/sub/{category_id}', 'CategoryController@getSub');

        // Brand
        Route::resource('brands', 'BrandController');

        // Product
        Route::resource('products', 'ProductController');

        // Orders
        Route::get('orders', 'OrderController@index');
        Route::get('orders/{id}/show', 'OrderController@show');

        // Subscribers
        Route::get('subscribers', 'UserController@subscriber');

    });

});
