<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\CategoryController;
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

Route::group(['prefix' => '/product', 'middleware' => 'auth'], function () {
    Route::get('/', [ProductController::class, 'product_list'])->name('product.list');
    Route::get('/category-product/{category_id}', [ProductController::class, 'category_product_list'])->name('product.category');
    Route::get('/add', [ProductController::class, 'add_product'])->name('product.add');
    Route::get('/edit/{id}', [ProductController::class, 'edit_product'])->name('product.edit');
    Route::post('/update', [ProductController::class, 'update_product'])->name('product.update');
    Route::post('/create', [ProductController::class, 'create_product'])->name('product.create');
    Route::post('/hide', [ProductController::class, 'hide_product'])->name('product.hide');


});

