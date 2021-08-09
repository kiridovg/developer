<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/books', [BookController::class, 'show'])->name('showBook');
Route::post('/users', [UserController::class, 'store'])->name('adduser');
Route::post('/user', [UserController::class, 'stores'])->name('updateuser');


Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
});

Route::group(['middleware' => ['auth', 'role:admin']], function() {
    Route::get('/dashboard/users', 'App\Http\Controllers\UserController@show')->name('dashboard.users');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard/books', 'App\Http\Controllers\BookController@show')->name('dashboard.books');
});
require __DIR__.'/auth.php';
