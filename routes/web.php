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

Route::get('/test', function () {
    return view('/main/test');
});

Auth::routes();

Route::get('/main/home', 'HomeController@index')->name('home');

Route::get('/home', function (){
    return view('main/home');
});

Route::get('/profile/{user}', 'ProfileController@index');
Route::get('/profie/{user}/edit','ProfilesControler@edit');
Route::patch('/profile/{user}', 'ProfilesController@update');