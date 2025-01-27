<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\CategoryController;
use App\Http\Controllers\V1\PointOfSaleController;
use App\Http\Controllers\V1\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => '/inventory', 'middleware' => 'auth'], function () {
    // Route::get('/', [ProductController::class, 'product_list'])->name('product.list');
});

Route::group(['prefix' => '/pos', 'middleware' => 'auth'], function () {
    Route::get('/', [PointOfSaleController::class, 'index'])->name('pos.index');
});

