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
    return redirect()->to('login');
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

//crud jadwal waktu
Route::post('alat/jadwal/{id}', 'AlatController@jadwal_store')->name('alat.jadwal.store');
Route::post('alat/jadwal/hapus/{id}', 'AlatController@jadwal_destroy')->name('alat.jadwal.destroy');

//data log monitoring
Route::get('log-monitoring', 'LogMonitoringController@index')->name('log-monitoring.index');
Route::get('log-monitoring/get-data', 'LogMonitoringController@get_data')->name('log-monitoring.get-data');

//profil pengguna
Route::get('profil', 'ProfilController@index')->name('profil.index');
Route::post('profil/update', 'ProfilController@update')->name('profil.update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard.index');

        Route::get('pengguna', 'Admin\PenggunaController@index')->name('admin.pengguna.index');
        Route::post('pengguna', 'Admin\PenggunaController@store')->name('admin.pengguna.store');
        Route::post('pengguna/{id}', 'Admin\PenggunaController@update')->name('admin.pengguna.update');
        Route::post('pengguna/destroy/{id}', 'Admin\PenggunaController@destroy')->name('admin.pengguna.destroy');

        Route::get('profil', 'Admin\ProfilController@index')->name('admin.profil.index');
        Route::post('profil/update', 'Admin\ProfilController@update')->name('admin.profil.update');
    });
// });
