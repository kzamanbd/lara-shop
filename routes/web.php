<?php

//cache clear commend
Route::get('/clear', function (){
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    return redirect(url('/'));
});


//frontend route
Route::get('/', 'EShopController@index')->name('/');
Route::get('product/details/product={slug}', 'EShopController@productDetails')->name('/product-details');
Route::get('products-category/{slug}', 'EShopController@categoryProducts')->name('category.products');

Route::get('products/cart', 'CartController@index')->name('carts.index');
Route::post('products/cart-store/', 'CartController@store')->name('carts.store');
Route::get('products/cart/{id}/', 'CartController@destroy')->name('carts.destroy');

Route::get('products/search', 'EShopController@search')->name('search.show');
Route::post('search/product', 'EShopController@searchAjax');
Route::post('process/checkout', 'EShopController@checkout')->name('checkout');
Route::get('process/checkout','CartController@index');

Route::post('districts/list', 'EShopController@districtsList');
Route::post('upazila/list', 'EShopController@upazilaList');
Route::post('product/shipping', 'EShopController@shipping')->name('shipping');
Route::get('product/review/', 'ReviewController@index')->name('review.index');
Route::post('product/review/', 'ReviewController@store')->name('review.store');

Route::get('payment', 'StripePaymentController@stripe')->name('stripe');
Route::post('payment/stripe', 'StripePaymentController@stripePost')->name('stripe.post');

//admin routes
Route::get('admin', 'AdminController@index')->name('admin');
Route::group(['prefix'=>'admin'], function(){
    Route::post('register', 'Admin\RegisterController@register');
    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login');
    Route::post('logout', 'Admin\LoginController@adminLogout')->name('admin.logout');
    //password reset
    Route::get('password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Admin\ResetPasswordController@reset')->name('password.update');
    //email verify
    Route::get('email/verify', 'Admin\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}', 'Admin\VerificationController@verify')->name('verification.verify');
    Route::get('email/resend', 'Admin\VerificationController@resend')->name('verification.resend');

    //category management route
    Route::get('categories', 'CategoryController@index')->name('categories.index');
    Route::get('category/create', 'CategoryController@create')->name('category.create');
    Route::post('category/store', 'CategoryController@store')->name('category.store');
    Route::get('category/delete/{id}', 'CategoryController@destroy')->name('category.delete');

    //products mamangment rotue
    Route::get('products', 'ProductController@index')->name('products.index');
    Route::get('products/create/', 'ProductController@create')->name('new.product');
    Route::get('products/{id}', 'ProductController@edit')->name('product.edit');
    
    Route::post('products/store/', 'ProductController@store')->name('products.store');
    Route::post('products/update/', 'ProductController@update')->name('products.update');
    Route::get('products/images/{id}', 'ProductController@productMultipleImage')->name('product.multiple.image');
    Route::post('products/image/store', 'ProductController@productMultipleImageStore')->name('product.multiple.image.store');
    Route::get('products/unpublished/{id}','ProductController@productUnpublished')->name('unpublished.product');
    Route::get('products/published/{id}', 'ProductController@productPublished')->name('published.product');
    Route::get('products/delete/{id}', 'ProductController@destroy')->name('product.destroy');

    //order management route
    Route::get('order/manage', 'AdminController@orderManage')->name('order.manage');
    Route::get('order/details={id}', 'AdminController@orderDetails')->name('admin.order.details');
    Route::get('invoice/print={id}', 'AdminController@orderInvoices')->name('admin.order.invoice');
    //setting
    Route::get('settings', 'SettingsController@index')->name('admin.settings');

});


//customer routes
Route::get('/customer', 'CustomerController@index')->name('customer');
Route::group(['prefix'=>'customer'], function(){
    Route::get('/login', 'Customer\LoginController@showLoginForm')->name('customer.login');
    Route::post('/login', 'Customer\LoginController@login')->name('customer.login');
    Route::post('/logout', 'Customer\LoginController@customerLogout')->name('customer.logout');
    Route::get('/register', 'Customer\RegisterController@showRegistrationForm')->name('customer.register');
    Route::post('/register', 'Customer\RegisterController@register')->name('customer.register');

    Route::get('/order-details/{id}', 'CustomerController@orderDetails')->name('customer.order.details');
    Route::get('/order-cancel/{id}', 'CustomerController@orderCancel')->name('customer.order.cancel');
    Route::get('/profile', 'CustomerController@customerProfile')->name('customer.profile');
});

Route::get('oauth/login/{provider}', 'Customer\LoginController@redirectToProvider')->name('customer.oauth.login');
Route::get('oauth/login/facebook/return', 'Customer\LoginController@providerCallback');
