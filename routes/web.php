<?php

//frontend route
Route::get('/', 'EShopController@index')->name('/');
Route::get('/product/details/product={slug}', 'EShopController@productDetails')->name('/product-details');
Route::get('/products/{slug}', 'EShopController@categoryProducts')->name('category.products');

Route::get('/product/cart', 'CartController@index')->name('carts.index');
Route::post('/product/cart-store/', 'CartController@store')->name('carts.store');
Route::get('/product/cart/{id}/', 'CartController@destroy')->name('carts.destroy');

Route::get('/product/search', 'EShopController@search')->name('search.show');
Route::post('/search/product', 'EShopController@searchAjax');
Route::post('/process/checkout', 'EShopController@checkout')->name('checkout');
Route::get('/process/checkout','CartController@index');

Route::post('/districts/list', 'EShopController@districtsList');
Route::post('/upazila/list', 'EShopController@upazilaList');
Route::post('/product/shipping', 'EShopController@shipping')->name('shipping');

Route::get('/payment', 'StripePaymentController@stripe')->name('stripe');
Route::post('/payment/stripe', 'StripePaymentController@stripePost')->name('stripe.post');

//admin routes
Route::get('/admin', 'AdminController@index')->name('admin');
Route::group(['prefix'=>'admin'], function(){
    Route::get('/join', 'Admin\RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register', 'Admin\RegisterController@register');
    Route::get('/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Admin\LoginController@login');
    Route::post('/logout', 'Admin\LoginController@adminLogout')->name('admin.logout');
    Route::get('/logout', 'Admin\LoginController@adminLogout')->name('admin.logout');
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
    Route::get('/categories/', 'CategoryController@index')->name('manage.categories');
    Route::get('/category/new', 'CategoryController@create')->name('category.create');
    Route::post('/category/store', 'CategoryController@store')->name('category.store');
    Route::get('/category/delete/id={id}', 'CategoryController@destroy')->name('category.delete');

    //products mamangment rotue
    Route::get('/products/', 'ProductController@index')->name('manage.products');
    Route::get('/product/new/', 'ProductController@create')->name('new.product');
    Route::get('/product/product_edit/id={product_id}', 'ProductController@edit')->name('product.edit');
    
    Route::post('/product/store/', 'ProductController@store')->name('product.store');
    Route::post('/product/update/', 'ProductController@update')->name('product.update');
    Route::get('/product/multiple-image={product_id}', 'ProductController@productMultipleImage')->name('product.multiple.image');
    Route::post('/product/multiple/image/store', 'ProductController@productMultipleImageStore')->name('product.multiple.image.store');
    Route::get('/product/unpublished/id={product_id}','ProductController@productUnpublished')->name('unpublished.product');
    Route::get('/product/published/id={product_id}', 'ProductController@productPublished')->name('published.product');
    Route::get('/product/delete/id={product_id}', 'ProductController@destroy')->name('product.delete');

    //order management route
    Route::get('/order/manage', 'AdminController@orderManage')->name('order.manage');
    Route::get('/order/details={id}', 'AdminController@orderDetails')->name('admin.order.details');
    Route::get('/invoice/print={id}', 'AdminController@orderInvoices')->name('admin.order.invoice');
    //setting
    Route::get('/settings', 'SettingsController@index')->name('admin.settings');

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

Route::get('customer-login/facebook', 'Customer\LoginController@redirectToProvider');
Route::get('customer-login/facebook/callback', 'Customer\LoginController@handleProviderCallback');
