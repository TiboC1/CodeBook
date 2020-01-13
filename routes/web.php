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

Route::post('/profile', 'ProfileController@store');

Route::get('/main/home', 'PostController@index')->name('home');
Route::get('/index', 'ProfileController@index');
Route::get('/profile/create','ProfileController@create');
Route::get('/profile/{profile}', 'ProfileController@show');
Route::get('/profile/{user}/edit','ProfileController@edit');
Route::patch('/profile/{user}', 'ProfileController@update')->name('profile');


Route::post('/main/home', 'PostController@store')->name('create');


Auth::routes();