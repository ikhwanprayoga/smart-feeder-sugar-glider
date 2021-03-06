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
    return redirect()->to('dashboard');
    return view('welcome');
});

//dashboard
Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');

//crud alat
Route::get('alat', 'AlatController@index')->name('alat.index');
Route::post('alat', 'AlatController@store')->name('alat.store');
Route::get('alat/{id}', 'AlatController@show')->name('alat.show');
Route::post('alat/{id}', 'AlatController@update')->name('alat.update');
Route::post('alat/hapus/{id}', 'AlatController@destroy')->name('alat.destroy');

//crud kendali waktu
Route::post('alat/kendali/{id}', 'AlatController@kendali_store')->name('alat.kendali.store');
Route::post('alat/kendali/hapus/{id}', 'AlatController@kendali_destroy')->name('alat.kendali.destroy');

//data log monitoring
Route::get('log-monitoring', 'LogMonitoringController@index')->name('log-monitoring.index');
Route::get('log-monitoring/get-data', 'LogMonitoringController@get_data')->name('log-monitoring.get-data');
