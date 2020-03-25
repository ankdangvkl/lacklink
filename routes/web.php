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
Route::post('/', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');

Route::get('/create-user', 'Admin\UserController@index');
Route::post('/create-user', 'Admin\UserController@createUser');
Route::get('/user-detail/{id}', 'Admin\UserController@detail');
Route::get('/user-status-update/{id}', 'Admin\UserController@updateUserStatus');
Route::get('/show-add-click/{id}', 'Admin\UserController@showAddClick');
Route::post('/add-click', 'Admin\UserController@addClick');

Route::get('/access', 'User\AccessController@index');
Route::get('/domain', 'User\DomainController@index');
Route::get('/package', 'User\PackageController@index');
Route::get('/campaign', 'User\CampaignController@index');
Route::get('/instruction', 'User\InstructionController@index');
Route::get('/payment', 'User\PaymentController@index');

Route::get('/link-add/{name}', 'User\LinkController@showAddLinkForm');
Route::post('/link-add', 'User\LinkController@addLinkForm');
Route::get('/link-edit/{name}/{id}', 'User\LinkController@showEditLinkForm');
Route::post('/link-edit', 'User\LinkController@editLinkForm');
Route::get('/link-remove/{name}/{id}', 'User\LinkController@remove');
