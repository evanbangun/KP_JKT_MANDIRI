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

Route::resource('user','UserController');

Route::get('/loginpage', 'UserController@loginpage');

Route::get('/logout', 'UserController@logout')->middleware('authuser');

Route::get('/', 'UserController@index')->middleware('authuser');

Route::get('/home', 'UserController@index')->middleware('authuser');

Route::post('/loginpost', 'UserController@loginpost');

Route::resource('tape','TapeController');

Route::get('/daftartape', 'TapeController@index')->middleware('authuser');

Route::get('/tapekosong', 'TapeController@index2')->middleware('authuser');

Route::get('/advancedsearch', 'TapeController@advancedsearch')->middleware('authuser');

Route::get('/tambahtapekosong', 'TapeController@createtapekosong')->middleware('authuser');

Route::get('/tapeedit/{id}','TapeController@tapeedit')->middleware('authuser');

Route::get('/tapedelete/{id}','TapeController@tapedelete')->middleware('authuser');

Route::post('/tapeupdate/{id}','TapeController@tapeupdate')->middleware('authuser');

Route::post('/tambahtapebatch','TapeController@storebatch')->middleware('authuser');

Route::post('/tambahtape','TapeController@tambahtape')->middleware('authuser');

Route::get('/searchdata', 'TapeController@searchdata')->middleware('authuser');

Route::post('/advsearchdatabc', 'TapeController@advsearchdatabc')->middleware('authuser');

Route::post('/advsearchdatakw', 'TapeController@advsearchdatakw')->middleware('authuser');

Route::get('/tambahtiket','TapeController@tambahticket')->middleware('authuser');

Route::get('/daftartiket', 'TapeController@tiket')->middleware('authuser');

Route::post('/tiket','TapeController@storetiket')->middleware('authuser');

Route::get('/daftarlokasi','DaftarController@indexlokasi')->middleware('authuser');

Route::get('/lokasiedit/{id}','DaftarController@lokasiedit')->middleware('authuser');

Route::get('/lokasidelete/{id}','DaftarController@lokasidelete')->middleware('authuser');

Route::get('/daftarrak','DaftarController@indexrak')->middleware('authuser');

Route::get('/daftarjenistape','DaftarController@indextape')->middleware('authuser');

Route::post('/tambahlokasi','TambahController@tambahlokasi')->middleware('authuser');

Route::get('/lokasiedit/{id}','TambahController@lokasiedit')->middleware('authuser');

Route::post('/lokasiupdate/{id}','TambahController@lokasiupdate')->middleware('authuser');

Route::get('/lokasidelete/{id}','TambahController@lokasidelete')->middleware('authuser');

Route::post('/tambahrak','TambahController@tambahrak')->middleware('authuser');

Route::get('/rakedit/{id}','TambahController@rakedit')->middleware('authuser');

Route::post('/rakupdate/{id}','TambahController@rakupdate')->middleware('authuser');

Route::get('/rakdelete/{id}','TambahController@rakdelete')->middleware('authuser');

Route::post('/tambahjenistape','TambahController@tambahjenistape')->middleware('authuser');

Route::get('/jenistapeedit/{id}','TambahController@jenistapeedit')->middleware('authuser');

Route::post('/jenistapeupdate/{id}','TambahController@jenistapeupdate')->middleware('authuser');

Route::get('/jenistapedelete/{id}','TambahController@jenistapedelete')->middleware('authuser');

Route::get('/stockopname','ActivityController@stockopname')->middleware('authuser');

Route::get('/movingtape','ActivityController@movingtape')->middleware('authuser');

Route::post('/movetape','ActivityController@movetape')->middleware('authuser');

Route::get('/testingtape','ActivityController@testingtape')->middleware('authuser');

Route::get('/createtesting','ActivityController@createtesting')->middleware('authuser');

Route::post('/konfirmasitesting','ActivityController@konfirmasitesting')->middleware('authuser');

Route::get('/edittest/{ktt}','ActivityController@edittest')->middleware('authuser');

Route::post('/updatetesting','ActivityController@updatetesting')->middleware('authuser');

Route::get('/openticket', 'DaftarController@open')->middleware('authuser');

Route::get('/closedticket', 'DaftarController@closed')->middleware('authuser');

Route::get('/overdueticket', 'DaftarController@overdue')->middleware('authuser');

Route::get('/tambahtiket','DaftarController@peminjaman')->middleware('authuser');

Route::get('/daftartiket', 'TapeController@tiket')->middleware('authuser');

Route::post('/postpeminjaman','DaftarController@storepeminjaman')->middleware('authuser');

Route::get('/updatedopen/{id}','DaftarController@edit')->middleware('authuser');

Route::get('/closetick/{id}','DaftarController@editclose')->middleware('authuser');
