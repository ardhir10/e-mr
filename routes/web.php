<?php

use App\Http\Controllers\DashboardController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'DashboardController@index');
// Route::get('/dashboard', 'DashboardController@index');
Route::get('/rekam-medis', 'RekamMedisController@index')->name('rekam-medis.index');
Route::get('/rawat-medis/detail', 'RekamMedisController@detail')->name('rekam-medis.detail');

Route::get('/rawat-jalan', 'RawatJalanController@index')->name('rawat-jalan.index');
Route::get('/rawat-inap', 'RawatInapController@index')->name('rawat-inap.index');
Route::get('/cppt/tambah', 'CpptController@create')->name('cppt.create');

Route::get('/asesmen/awal-dewasa/perawat', 'AsesmenController@awalDewasaPerawat')->name('asesmen.awal-dewasa.perawat');


