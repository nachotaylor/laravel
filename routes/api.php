<?php

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

Route::group(['as' => 'api::'], function () {

    Route::group(['prefix' => 'auth', 'as' => 'auth::'], function () {
        Route::post('login', 'Api\AuthController@login')->name('login');
        Route::post('logout', 'Api\AuthController@logout')->name('logout');
    });

    Route::group(['prefix' => 'user', 'as' => 'user::'], function () {
        Route::get('get/{id}', 'Api\UserController@get')->name('get');
        Route::get('', 'Api\UserController@all')->name('all');
        Route::post('create', 'Api\UserController@create')->name('create');
        Route::put('update/{id}', 'Api\UserController@update')->name('update');
        Route::delete('delete/{id}', 'Api\UserController@delete')->name('delete');
    });
});