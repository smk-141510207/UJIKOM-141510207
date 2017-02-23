<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::resource('/jabatan', 'JabatanController');
Route::resource('/golongan', 'GolonganController');
Route::resource('/pegawai', 'PegawaiController');
Route::resource('/lemburkate', 'kategorylemburController');
Route::resource('/lemburp', 'lemburpegawaiController');
Route::resource('/tunjangan', 'tunjanganController');
Route::resource('/tunjangpegawai', 'TunjanganpController');
Route::resource('/penggajian', 'penggajianController');
