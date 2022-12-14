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

Route::get('/dashboard', function () {
    return view('backend.dashboard.index');
})->middleware(['auth'])->name('dashboard');

Route::get('/users-info', function () {
    return view('backend.users.index');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], function() {
    
    Route::get('categories-datatable', 'App\Http\Controllers\Backend\CategoryController@datatable')->name('categories-datatable');
    Route::get('products-datatable', 'App\Http\Controllers\Backend\ProductController@datatable')->name('products-datatable');
    Route::get('notifications-datatable', 'App\Http\Controllers\Backend\NotificationController@datatable')->name('notifications-datatable');
    Route::get('translations-datatable', 'App\Http\Controllers\Backend\TranslationController@datatable')->name('translations-datatable');

    Route::resource('roles', 'App\Http\Controllers\Backend\RoleController');
    Route::resource('users', 'App\Http\Controllers\Backend\UserController');
    Route::resource('products', 'App\Http\Controllers\Backend\ProductController');
    Route::resource('categories', 'App\Http\Controllers\Backend\CategoryController');
    Route::resource('translations', 'App\Http\Controllers\Backend\TranslationController');
    Route::resource('notifications', 'App\Http\Controllers\Backend\NotificationController');

    Route::get('user-data', 'App\Http\Controllers\Backend\CalenderController@userdata')->name("user-calendar-data");
    Route::get('product-data', 'App\Http\Controllers\Backend\CalenderController@productdata')->name("product-calendar-data");

    Route::post('/storeimgae', 'App\Http\Controllers\Backend\ProductController@storeimage'); 
    Route::post('/product-image', 'App\Http\Controllers\Backend\ProductController@product_image'); 
    Route::post('/images-delete', 'App\Http\Controllers\Backend\ProductController@product_image_remove'); 

    Route::post('/store', 'App\Http\Controllers\Backend\ProductController@store')->name('form.data');

    
    Route::get('product-eloquent', 'App\Http\Controllers\Backend\ProductController@eloquent');
   
});
