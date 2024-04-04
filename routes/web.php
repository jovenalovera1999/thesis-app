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
        Route::get('/admins', 'index');
        Route::get('/admin/dashboard', 'dashboard');
        Route::get('/add/account', 'addAccount');
        Route::get('/admin/create', 'create');
        Route::get('/admin/edit/{id}', 'edit');
        Route::get('/admin/delete/{id}', 'delete');
        Route::get('/admin/reset/password/{id}', 'resetPassword');
        Route::get('/confirm/logout', 'logout');

        Route::post('/admin/store', 'store');
        Route::post('/admin/process/logout', 'processLogout');

        Route::put('/admin/update/{admin}', 'update');
        Route::put('/admin/process/reset/password/{admin}', 'processResetPassword');

        Route::delete('/admin/destroy/{admin}', 'destroy');
    });

    Route::controller(StudentController::class)->group(function() {
        Route::get('/students', 'index');
        Route::get('/students/login/histories', 'loginHistories');
        Route::get('/student/register', 'create');
        Route::get('/student/edit/{id}', 'edit');
        Route::get('/student/edit/password/{id}', 'editPassword');
        Route::get('/student/delete/{id}', 'delete');
    
        Route::post('/student/store', 'store');

        Route::put('/student/update/{student}', 'update');
        Route::put('/student/update/password/{student}', 'updatePassword');

        Route::delete('/student/destroy/{student}', 'destroy');
    });
});