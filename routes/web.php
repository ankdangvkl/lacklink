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
Route::get('/user/dashboard', function() {
    return view('user/dashboard/index');
});
Route::get('/user/access', function() {
    return view('user/dashboard/access/index');
});
Route::get('/user/domain', function() {
    return view('user/dashboard/domain/index');
});
Route::get('/user/package', function() {
    return view('user/dashboard/package/index');
});
Route::get('/user/campaign', function() {
    return view('user/dashboard/campaign/index');
});
Route::get('/user/instruction', function() {
    return view('user/dashboard/instruction/index');
});
Route::get('/admin/dashboard', function() {
    return view('admin/dashboard/index');
});
Route::get('/admin/create-user', 'UserController@index');
Route::post('/admin/create-user', 'UserController@createUser');
