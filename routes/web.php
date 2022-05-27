<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;

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
        'index'  => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store'  => 'admin.categories.store',
        'show'   => 'admin.categories.show',
        'edit'   => 'admin.categories.edit',
        'update' => 'admin.categories.update',
    ]);

    Route::get('/dashboard/products',      [DashboardController::class, 'products'])     ->name('dashboard-products');
    Route::get('/dashboard/collections',   [DashboardController::class, 'collections'])  ->name('dashboard-collections');
    Route::get('/dashboard/orders',        [DashboardController::class, 'orders'])       ->name('dashboard-orders');
    Route::get('/dashboard/notifications', [DashboardController::class, 'notifications'])->name('dashboard-notifications');
    Route::get('/dashboard/profile',       [DashboardController::class, 'profile'])      ->name('dashboard-profile');
    Route::get('/dashboard/accounts',      [DashboardController::class, 'accounts'])     ->name('dashboard-accounts');
});


Route::resource('/products', ProductController::class);
Route::get('/products/{product}/{color}', [ProductController::class, 'show'])->name('product-color');

Route::resource('/collections', CollectionController::class);
Route::get('/collections/{collection:slug}', [CollectionController::class, 'show'])->name('products-show');



require __DIR__.'/auth.php';
