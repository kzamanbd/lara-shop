<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Livewire\Auth\Login;

Route::view('/', 'welcome');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';



//cache clear commend
Route::get('/clear', function () {
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    return redirect(url('/'));
});


//frontend route
Route::get('/', [EShopController::class, 'index'])->name('home');

Route::prefix('product')->group(function () {
    Route::get('/{slug}', [EShopController::class, 'productDetails'])->name('product-details');
    Route::get('review', [ReviewController::class, 'index'])->name('review.index');
    Route::post('review', [ReviewController::class, 'store'])->name('review.store');
    Route::post('shipping', [EShopController::class, 'shipping'])->name('shipping');
    Route::get('category/{slug}', [EShopController::class, 'categoryProducts'])->name('category.products');
    Route::get('cart', [CartController::class, 'index'])->name('carts.index');
    Route::post('cart-store', [CartController::class, 'store'])->name('carts.store');
    Route::get('cart/{id}', [CartController::class, 'destroy'])->name('carts.destroy');
    Route::get('search', [EShopController::class, 'search'])->name('search.show');
});

Route::get('process/checkout', [CartController::class, 'index']);
Route::post('search/product', [EShopController::class, 'searchAjax']);
Route::post('process/checkout', [EShopController::class, 'checkout'])->name('checkout');

Route::post('districts/list', [EShopController::class, 'districtsList']);
Route::post('upazila/list', [EShopController::class, 'upazilaList']);

Route::middleware('auth')->prefix('feature')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin');

    Route::resource('category', CategoryController::class);
    Route::resource('products', ProductController::class);

    Route::prefix('products')->group(function () {
        Route::get('image/{id}', [ProductController::class, 'productMultipleImage'])->name('products.image');
        Route::post('image/store', [ProductController::class, 'productMultipleImageStore'])->name('product.multiple.image.store');
        Route::get('unpublished/{id}', [ProductController::class, 'productUnpublished'])->name('unpublished.product');
        Route::get('published/{id}', [ProductController::class, 'productPublished'])->name('published.product');
    });

    Route::get('config', [SettingsController::class, 'index'])->name('admin.settings');
    Route::get('local-sales', [AdminController::class, 'orderManage'])->name('order.manage');
    Route::get('order-details/{id}', [AdminController::class, 'orderDetails'])->name('admin.order.details');
    Route::get('invoice/print={id}', [AdminController::class, 'orderInvoices'])->name('admin.order.invoice');
});

Route::prefix('customer')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('customer');
    Route::get('login', Login::class)->name('login');

    Route::middleware('auth')->group(function () {
        Route::get('profile', [CustomerController::class, 'customerProfile'])->name('customer.profile');
        Route::get('order-details/{id}', [CustomerController::class, 'orderDetails'])->name('customer.order.details');
        Route::get('order-cancel/{id}', [CustomerController::class, 'orderCancel'])->name('customer.order.cancel');
    });
});