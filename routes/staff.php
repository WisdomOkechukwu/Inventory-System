<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
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

Route::group(['prefix' => '/staff', 'middleware' => 'auth'], function () {
    Route::get('/', [StaffController::class, 'staff_list'])->name('staff.list');
    Route::get('/information/{id}', [StaffController::class, 'show_staff'])->name('staff.show');
    Route::get('/add', [StaffController::class, 'add_staff'])->name('staff.add');
    Route::post('/create', [StaffController::class, 'create_staff'])->name('staff.create');
    Route::post('/update', [StaffController::class, 'update_staff'])->name('staff.update');
    Route::post('/update-password', [StaffController::class, 'update_staff_password'])->name('staff.update.password');
    Route::post('/delete-staff', [StaffController::class, 'delete_staff'])->name('staff.delete');
});

