<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Route;


Route::controller(PageController::class)->middleware('webActive')->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/faqs', 'faqs')->name('faqs');
});

Route::middleware('admin')->group(function () {
    Route::get('/dashboard',               [DashboardController::class, 'index'])        ->name('dashboard');

    Route::get('/dashboard/settings',      [DashboardController::class, 'settings'])     ->name('dashboard-settings');
    Route::post('/dashboard/settings',     [DashboardController::class, 'saveSettings']);

    Route::resource('/dashboard/categories', App\Http\Controllers\Admin\CategoryController::class)->names([
        'index'   => 'admin.categories.index',
        'create'  => 'admin.categories.create',
        'store'   => 'admin.categories.store',
        'show'    => 'admin.categories.show',
        'edit'    => 'admin.categories.edit',
        'update'  => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy'
    ]);
    Route::patch('/dashboard/categories/{product}/delete', [App\Http\Controllers\Admin\CategoryController::class, 'deleteProductFromCategory'])
        ->name('admin.categories.product.delete');

    Route::resource('/dashboard/collections', App\Http\Controllers\Admin\CollectionController::class)->names([
        'index'   => 'admin.collections.index',
        'create'  => 'admin.collections.create',
        'store'   => 'admin.collections.store',
        'show'    => 'admin.collections.show',
        'edit'    => 'admin.collections.edit',
        'update'  => 'admin.collections.update',
        'destroy' => 'admin.collections.destroy'
    ]);
    Route::patch('/dashboard/collections/{collection}/{product}/delete', [App\Http\Controllers\Admin\CollectionController::class, 'deleteProductFromCollection'])
        ->name('admin.collections.product.delete');

    Route::resource('/dashboard/products', App\Http\Controllers\Admin\ProductController::class)->names([
        'index'   => 'admin.products.index',
        'create'  => 'admin.products.create',
        'store'   => 'admin.products.store',
        'show'    => 'admin.products.show',
        'edit'    => 'admin.products.edit',
        'update'  => 'admin.products.update',
        'destroy' => 'admin.products.destroy'
    ]);

    Route::get('/dashboard/product/scrap', [App\Http\Controllers\Admin\ProductController::class, 'scrap'])
    ->name('admin.products.scrap');
    Route::post('/dashboard/product/scrap', [App\Http\Controllers\Admin\ProductController::class, 'scrapStore'])
    ->name('admin.products.scrapStore');

    Route::get('/dashboard/products/{product}/color', [\App\Http\Controllers\Admin\ProductColorController::class, 'create'])
        ->name('admin.products.color.create');
    Route::post('/dashboard/products/{product}/color', [\App\Http\Controllers\Admin\ProductColorController::class, 'store'])
        ->name('admin.products.color.store');

    Route::resource('/dashboard/orders', \App\Http\Controllers\Admin\OrderController::class)->names([
       'index'   => 'admin.orders.index',
       'show'    => 'admin.orders.show',
       'create'  => 'admin.orders.create',
       'store'   => 'admin.orders.store',
       'edit'    => 'admin.orders.edit',
       'update'  => 'admin.orders.update',
       'destroy' => 'admin.orders.destroy',
    ]);

    Route::get('/dashboard/profile',       [DashboardController::class, 'profile'])      ->name('dashboard-profile');
    Route::get('/dashboard/accounts',      [DashboardController::class, 'accounts'])     ->name('dashboard-accounts');
});


Route::resource('/products', ProductController::class);
Route::get('/products/{product}/{color}', [ProductController::class, 'show'])->name('product-color');

Route::resource('/collections', CollectionController::class);
Route::get('/collections/{collection:slug}', [CollectionController::class, 'show'])->name('products-show');



require __DIR__.'/auth.php';
