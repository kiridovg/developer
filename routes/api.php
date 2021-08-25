<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:api');
Route::group(['middleware' => ['web']], function () {
    Route::get('/login/google', [AuthenticatedSessionController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('/login/google/callback', [AuthenticatedSessionController::class, 'handleGoogleCallback']);

    Route::get('/login/facebook', [AuthenticatedSessionController::class, 'redirectToFacebook'])
        ->name('login.facebook');
    Route::get('/login/facebook/callback', [AuthenticatedSessionController::class, 'handleFacebookCallback']);
});
