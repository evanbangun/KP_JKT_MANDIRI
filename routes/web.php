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

Route::get('/home', 'TapeController@index');

Route::get('/tapekosong', 'TapeController@index2');

Route::get('/advancedsearch', 'TapeController@advancedsearch');

Route::get('/tambahtapekosong', 'TapeController@createtapekosong');

Route::post('/tambahtapebatch','TapeController@storebatch');

Route::post('/tambahtape','TapeController@tambahtape');

Route::get('/searchdata', 'TapeController@searchdata');

Route::post('/advsearchdatabc', 'TapeController@advsearchdatabc');

Route::post('/advsearchdatakw', 'TapeController@advsearchdatakw');

Route::get('/tambahtiket','TapeController@tambahticket');

Route::get('/daftartiket', 'TapeController@tiket');

Route::post('/tiket','TapeController@storetiket');

Route::get('/daftarlokasi','DaftarController@indexlokasi');

Route::get('/daftarrak','DaftarController@indexrak');

Route::get('/daftarjenistape','DaftarController@indextape');

Route::resource('peminjaman','PeminjamanController');

Route::post('/tambahlokasi','TambahController@tambahlokasi');

Route::post('/tambahrak','TambahController@tambahrak');

Route::post('/tambahjenistape','TambahController@tambahjenistape');

Route::get('/stockopname','ActivityController@stockopname');

Route::get('/movingtape','ActivityController@movingtape');

Route::post('/movetape','ActivityController@movetape');

Route::get('/testingtape','ActivityController@testingtape');

Route::get('/createtesting','ActivityController@createtesting');

Route::post('/konfirmasitesting','ActivityController@konfirmasitesting');

Route::get('/edittest/{ktt}','ActivityController@edittest');

Route::post('/updatetesting','ActivityController@updatetesting');