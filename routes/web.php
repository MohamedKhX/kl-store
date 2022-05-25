<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;


Route::get('/', [PageController::class, 'home'])->name('home');

Route::resource('/products', ProductController::class);
Route::get('/products/{product}/{color}', [ProductController::class, 'show'])->name('product-color');

Route::resource('/collections', CollectionController::class);
Route::get('/collections/{collection:slug}', [CollectionController::class, 'show'])->name('products-show');

Route::get('/faqs', [PageController::class, 'faqs'])->name('faqs');


require __DIR__.'/auth.php';
