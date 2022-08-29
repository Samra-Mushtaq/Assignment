<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
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
// Route::post('/login', [RegisteredUserController::class, 'store']);

Route::post('login', 'App\Http\Controllers\API\UserController@login');
Route::post('/register', 'App\Http\Controllers\API\UserController@store');

Route::resource('products', 'App\Http\Controllers\API\ProductController')->middleware('auth:sanctum');
Route::resource('categories', 'App\Http\Controllers\API\CategoryController')->middleware('auth:sanctum');

Route::resource('translations', 'App\Http\Controllers\API\TranslationController')->middleware('auth:sanctum');
Route::resource('notifications', 'App\Http\Controllers\API\NotificationController')->middleware('auth:sanctum');
// Route::post('/register', [RegisteredUserController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
