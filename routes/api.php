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
Route::get('/geticd', 'AsesmenDokterController@getIcd')->name('api.icd.search');

Route::post('/dashboardDokterRawatjalan', 'DashboardController@chartGraphicDokter')->name('api.dashboard-rawat-jalan-dokter');
Route::post('/dashboardNonDokterRawatjalan', 'DashboardController@chartGraphicNonDokter')->name('api.dashboard-rawat-jalan-non-dokter');

Route::post('/dashboardNonDokterRawatInap', 'DashboardController@chartGraphicNonDokterRi')->name('api.dashboard-rawat-inap-non-dokter');
Route::post('/dashboardDokterRawatInap', 'DashboardController@chartGraphicDokterRi')->name('api.dashboard-rawat-inap-dokter');
