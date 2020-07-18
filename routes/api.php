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

Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/details', 'UserController@userDetails');
    Route::get('/book/showAll', 'BookController@showWithSoftDelete')->name('book.showAll');
    Route::get('/book/softDelete', 'BookController@onlySoftDeleted')->name('book.showOnlySoftDeleted');
    Route::patch('/book/restore/{book}', 'BookController@restore')->name('book.restore');
    Route::delete('/book/softDelete/{book}', 'BookController@softDelete')->name('book.softDelete');
    Route::apiResource('/book', 'BookController');      
});


