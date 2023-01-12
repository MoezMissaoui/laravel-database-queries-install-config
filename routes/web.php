<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('users', 'UserController@index')->name('users');

Route::get('db/transactions', 'UserController@db_transactions')->name('db_transactions');

Route::get('db/create/{name}', 'UserController@create_db')->name('create_db');



Route::get('comments', 'CommentController@index')->name('comments');
