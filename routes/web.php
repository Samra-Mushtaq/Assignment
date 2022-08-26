<?php

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
// Route::get('/a', function () {
    // return view('dashboard');
// }); //

Route::get('/dashboard', function () {
    return view('backend.dashboard.index');
})->middleware(['auth'])->name('dashboard');

Route::get('/users-info', function () {
    return view('backend.users.index');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

 
Route::get('/search-users', 'App\Http\Controllers\Backend\UserController@index')->name('searchusers.index');


Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', 'App\Http\Controllers\Backend\RoleController');
    Route::resource('users', 'App\Http\Controllers\Backend\UserController');
    Route::resource('products', 'App\Http\Controllers\Backend\ProductController');
    Route::resource('categories', 'App\Http\Controllers\Backend\CategoryController');
    
    Route::resource('translations', 'App\Http\Controllers\Backend\TranslationController');
    Route::resource('notifications', 'App\Http\Controllers\Backend\NotificationController');

    Route::post('products_update', 'App\Http\Controllers\Backend\ProductController@update');
});
