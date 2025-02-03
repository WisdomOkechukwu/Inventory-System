<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\CategoryController;
use App\Http\Controllers\V1\InventoryController;
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
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [InventoryController::class, 'dashboard'])->name('dashboard');
    Route::get('/orders', [InventoryController::class, 'orders'])->name('orders');
    Route::get('/order/{order_id}', [InventoryController::class, 'view_orders'])->name('view.orders');
    Route::get('/in-stock', [InventoryController::class, 'inStock'])->name('in_stock');
    Route::get('/out-of-stock', [InventoryController::class, 'outOfStock'])->name('out_stock');
});

Route::group(['prefix' => '/pos', 'middleware' => 'auth'], function () {
    Route::get('/', [PointOfSaleController::class, 'index'])->name('pos.index');
    Route::get('/saved-pos', [PointOfSaleController::class, 'saved_pos'])->name('pos.saved');
    Route::post('/view-order/{id}', [PointOfSaleController::class, 'view_order'])->name('pos.view.order');
    Route::post('/cancel-order/{id}', [PointOfSaleController::class, 'cancel_order'])->name('pos.cancel.order');
});

