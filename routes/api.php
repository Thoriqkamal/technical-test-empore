<?php

use Illuminate\Http\Request;

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

Route::get('/books','ApiBukuController@getBook');
Route::get('/books/{code}', 'ApiBukuController@getSingleBook');
Route::post('/books', 'ApiBukuController@createBook');
Route::put('/books/{code}', 'ApiBukuController@updateBook');
Route::delete('/books/{code}', 'ApiBukuController@deleteBook');
