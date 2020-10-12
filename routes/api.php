<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::any('bar', function () {
    return 'This is a request from any HTTP verb';
});


Route::post('login', 'App\Http\Controllers\ApiController@login');
Route::post('register',  [ApiController::class, 'register']);

Route::post('test',  [ApiController::class, 'test']);

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'App\Http\Controllers\ApiController@logout');

    Route::get('user', 'App\Http\Controllers\ApiController@getAuthUser');

    Route::get('products', 'App\Http\Controllers\ProductController@index');
    Route::get('products/{id}', 'App\Http\Controllers\ProductController@show');
    Route::post('products', 'App\Http\Controllers\ProductController@store');
    Route::put('products/{id}', 'App\Http\Controllers\ProductController@update');
    Route::delete('products/{id}', 'App\Http\Controllers\ProductController@destroy');
});




