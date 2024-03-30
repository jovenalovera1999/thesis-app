<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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

Route::controller(AdminController::class)->group(function() {
    Route::get('/admin/login', 'login')->name('login');
    Route::post('/admin/process/login', 'processLogin');
});

Route::controller(StudentController::class)->group(function() {
    Route::get('/', 'loginPage');
    Route::post('/student/process/login', 'processLogin');
});

Route::group(['middleware' => 'auth:admin'], function() {
    Route::controller(AdminController::class)->group(function() {
        Route::get('/admin/dashboard', 'dashboard');
    });

    Route::controller(StudentController::class)->group(function() {
        Route::get('/students/login/histories', 'index');
        Route::get('/student/register', 'create');
    
        Route::post('/student/store', 'store');
    });
});