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

/* page menu */
Route::get('/', function () {
    return view('login.login');
});

Route::get('/register', function(){
    return view('login.register');
});

// Route Ajax
Route::post('/ajax_login', 'ajaxController@login');
Route::post('/ajax_register', 'ajaxController@register');
Route::post('/ajax_logout', 'ajaxController@logout');

Route::get('/user', 'UserController@index');
