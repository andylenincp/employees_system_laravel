<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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

Route::get('/', function () {
    return view('auth.login');
});

/*

Route::get('/employee', function () {
    return view('employee.index');
});

Route::get('/employee/create', [EmployeeController::class, 'create']);

*/

Route::resource('employee', EmployeeController::class)->middleware('auth');
Auth::routes(['register' => false, 'reset' => false]);

Route::get('/home', [App\Http\Controllers\EmployeeController::class, 'index'])->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\EmployeeController::class, 'index'])->name('home');
});