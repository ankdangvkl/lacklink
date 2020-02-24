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

Route::get('/', 'LoginController@index');
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/access', 'AccessController@index');
Route::get('/domain', 'DomainController@index');
Route::get('/package', 'PackageController@index');
Route::get('/campaign', 'CampaignController@index');
Route::get('/instruction', 'InstructionController@index');
Route::get('/create-user', 'UserController@index');
Route::post('/create-user', 'UserController@createUser');
