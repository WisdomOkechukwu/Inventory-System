<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\V1\CategoryController;
use App\Http\Controllers\V1\StaffController;

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

Route::group(['prefix' => '/category', 'middleware' => 'auth'], function () {
    Route::get('/', [CategoryController::class, 'category_list'])->name('category.list');
    Route::get('/add', [CategoryController::class, 'add_category'])->name('category.add');
    Route::post('/create', [CategoryController::class, 'create_category'])->name('category.create');
    Route::get('/edit/{id}', [CategoryController::class, 'show_category'])->name('category.edit');
    Route::post('/update', [CategoryController::class, 'update_category'])->name('category.update');
});

