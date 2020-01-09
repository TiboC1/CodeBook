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

Route::get('/', function () {
    return view('/main/welcome');
});

Auth::routes();

Route::get('/main/home', 'PostController@index')->name('home');
Route::get('/main/test', 'HomeController@index');

Route::post('/main/home', 'PostController@store');
