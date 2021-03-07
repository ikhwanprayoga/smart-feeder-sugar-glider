<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('kirim-data/{alat_id}/{makanan}/{air}', 'ApiController@kirim_data');
Route::get('get-data-monitoring/{alat_id}', 'ApiController@monitoring');
Route::get('get-last-time/{alat_id}', 'ApiController@last_time');
