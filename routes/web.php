<?php

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

Route::controller(StudentController::class)->group(function() {
    Route::get('/', 'loginPage');
    Route::post('/student/login', 'loginProcess');
});

Route::controller(StudentController::class)->group(function() {
    Route::get('/student/register', 'create');

    Route::post('/student/store', 'store');
});
