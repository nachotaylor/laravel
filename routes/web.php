<?php

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/', 'Web\HomeController@index')->name('home');
Route::get('home', 'Web\HomeController@index');

Route::group(['prefix' => 'user', 'as' => 'user::'], function () {
    Route::get('index', 'Web\UserController@index')->name('index');
    Route::post('create', 'Web\UserController@create')->name('create');
    Route::put('update/{id}', 'Web\UserController@update')->name('update');
    Route::delete('delete/{id}', 'Web\UserController@delete')->name('delete');
});