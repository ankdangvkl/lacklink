<?php

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

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Admin\LoginController@index');
    Route::group(['prefix' => 'dashboard'], function () {
        Route::post('/', 'Admin\DashboardController@index');
        Route::get('/campaign', 'Admin\DashboardController@campaign');
    });
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/', 'User\LoginController@index');
    Route::group(['prefix' => 'dashboard'], function () {
        Route::post('/', 'Admin\DashboardController@index');
        Route::get('/campaign', 'Admin\DashboardController@campaign');
    });
});
