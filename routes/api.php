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

Route::post('login', 'App\Http\Controllers\API\UserController@login');

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('register', 'App\Http\Controllers\API\UserController@store');
    Route::post('search-api', 'App\Http\Controllers\API\ProductController@search');
    Route::apiResource('products', 'App\Http\Controllers\API\ProductController');
    Route::apiResource('categories', 'App\Http\Controllers\API\CategoryController');
    Route::apiResource('translations', 'App\Http\Controllers\API\TranslationController');
    Route::apiResource('notifications', 'App\Http\Controllers\API\NotificationController');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
