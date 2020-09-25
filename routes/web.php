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

Route::group(['middleware' => ['role:customer|sales|admin']], function () {
    Route::get('categories/{category}/delete', 'App\Http\Controllers\CategoryController@delete')
        ->name('categories.delete');
    Route::resource('/categories', 'App\Http\Controllers\CategoryController');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
