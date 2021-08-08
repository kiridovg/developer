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
Route::get('/users', [UserController::class, 'show'])->name('showBook');
Route::post('/users', [UserController::class, 'store'])->name('adduser');
Route::post('/user', [UserController::class, 'stores'])->name('updateuser');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard')->middleware('verified');

require __DIR__.'/auth.php';
