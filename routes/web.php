<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [PageController::class, 'home'])->name('home');


Route::resource('/products', ProductController::class);
Route::get('/products/{product}/{color}', [ProductController::class, 'show'])->name('product-color');

Route::resource('/collections', CollectionController::class);
Route::get('/collections/{collection:slug}', [CollectionController::class, 'show'])->name('products-show');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
