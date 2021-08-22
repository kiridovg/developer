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
Route::post('/books', [BookController::class, 'store'])->name('addbook');
Route::post('/book', [BookController::class, 'stores'])->name('updatebook');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/dashboard/users', [UserController::class, 'show'])->name('dashboard.users');
    Route::post('/dashboard/users/add', [UserController::class, 'store'])->name('adduser');
    Route::post('/dashboard/users/update', [UserController::class, 'stores'])->name('updateuser');

    Route::get('/dashboard/bookEditor', [BookController::class, 'showEditor'])->name('dashboard.bookEditor');
    Route::get('/dashboard/bookEditor/addBook', [BookController::class, 'showAddBook'])
        ->name('dashboard.bookEditor.addBook');
    Route::post('/dashboard/bookEditor/addBook', [BookController::class, 'create'])
        ->name('dashboard.bookEditor.addBook');
    Route::get('/dashboard/bookEditor/editBook/{id}/', [BookController::class, 'showEditBook'])
        ->name('dashboard.bookEditor.editBook');
    Route::put('/dashboard/bookEditor/editBook/update/{id}/', [BookController::class, 'update'])
        ->name('posts.update');
    Route::delete('/dashboard/bookEditor/{id}/delete', [BookController::class, 'delete'])
        ->name('dashboard.bookEditor.deleteBook');
});



Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard/books', 'App\Http\Controllers\BookController@show')->name('dashboard.books');
});
require __DIR__.'/auth.php';
