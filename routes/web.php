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

Route::post('/follow/{user}', 'FollowingController@store');
Route::post('/profile', 'ProfileController@store');
Route::get('/main/{user}', 'PostController@index')->name('dashboard');
Route::get('/index', 'ProfileController@index');

Route::get('/profile/{user}', 'ProfileController@show')->name('profile.show');
Route::get('/profile/{user}/edit','ProfileController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfileController@update')->name('profile.update');
Route::delete('/profile/{user}', 'ProfileController@destroy')->name('profile.delete');

Route::post('/main/{user}', 'PostController@store')->name('post.create');


Auth::routes();