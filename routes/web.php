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


Route::resource('tape','TapeController');

Route::get('/', 'TapeController@index');

Route::get('/searchdata', 'TapeController@searchdata');

// Route::get('/home', function () {
//     return view('home');
// });