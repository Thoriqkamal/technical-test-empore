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

// Route User
Route::get('/users', 'UserController@index')->name('users');
Route::get('/users-list', 'UserController@usersList')->name('users-list');
Route::post('/create-user', 'UserController@createUser')->name('create-user');
Route::post('/get-user', 'UserController@getUser')->name('get-user');
Route::post('/update-user', 'UserController@updateUser')->name('update-user');
Route::delete('/user/{id}', 'UserController@deleteUser');

//Route Master Buku
Route::get('/master-buku', 'MasterBukuController@index')->name('master-buku');
Route::get('/master-buku-list', 'MasterBukuController@MasterBukuList')->name('master-buku-list');
Route::post('/create-master-buku', 'MasterBukuController@createMasterBuku')->name('create-master-buku');
