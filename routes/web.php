<?php

use App\ExportClass;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

require __DIR__ . '/auth.php';
require __DIR__ . '/staff.php';
require __DIR__ . '/category.php';
require __DIR__ . '/product.php';
require __DIR__ . '/inventory.php';

Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    Route::get('/home', [RoutingController::class, 'index']);

    Route::post('/export_daily_tx', [RoutingController::class, 'export'])
    ->middleware('auth')
    ->name('export_daily_tx');
        
});


