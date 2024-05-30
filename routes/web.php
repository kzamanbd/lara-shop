<?php

use Livewire\Volt\Volt;
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

Route::middleware('auth')->prefix('adm')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin');
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
    });

    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::get('create', [ProductController::class, 'create'])->name('new.product');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('store', [ProductController::class, 'store'])->name('products.store');
        Route::post('update', [ProductController::class, 'update'])->name('products.update');
        Route::get('images/{id}', [ProductController::class, 'productMultipleImage'])->name('product.multiple.image');
        Route::post('image/store', [ProductController::class, 'productMultipleImageStore'])->name('product.multiple.image.store');
        Route::get('unpublished/{id}', [ProductController::class, 'productUnpublished'])->name('unpublished.product');
        Route::get('published/{id}', [ProductController::class, 'productPublished'])->name('published.product');
        Route::get('delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    });

    Route::get('local-sales', [AdminController::class, 'orderManage'])->name('order.manage');
    Route::get('order-details/{id}', [AdminController::class, 'orderDetails'])->name('admin.order.details');
    Route::get('invoice/print={id}', [AdminController::class, 'orderInvoices'])->name('admin.order.invoice');
    Route::get('settings', [SettingsController::class, 'index'])->name('admin.settings');
});

Route::prefix('customer')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('customer');
    Volt::route('login', 'pages.auth.login')->name('login');

    Route::middleware('auth')->group(function () {
        Route::get('order-details/{id}', [CustomerController::class, 'orderDetails'])->name('customer.order.details');
        Route::get('order-cancel/{id}', [CustomerController::class, 'orderCancel'])->name('customer.order.cancel');
        Route::get('profile', [CustomerController::class, 'customerProfile'])->name('customer.profile');
    });
});
