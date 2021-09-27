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

// --- SATUAN TUGAS MEDIS
Route::get('/data-master/satuan-tugas-medis', 'SatuanTugasMedisController@index')->name('satuan-tugas-medis.index');
Route::get('/data-master/satuan-tugas-medis/add', 'SatuanTugasMedisController@create')->name('satuan-tugas-medis.create');
Route::post('/data-master/satuan-tugas-medis', 'SatuanTugasMedisController@store')->name('satuan-tugas-medis.store');
Route::get('/data-master/satuan-tugas-medis/{id}/edit', 'SatuanTugasMedisController@edit')->name('satuan-tugas-medis.edit');
Route::post('/data-master/satuan-tugas-medis/{id}/update', 'SatuanTugasMedisController@update')->name('satuan-tugas-medis.update');
Route::get('/data-master/satuan-tugas-medis/{id}/delete', 'SatuanTugasMedisController@delete')->name('satuan-tugas-medis.delete');


// --- LAYANAN/BAGIAN
Route::get('/data-master/layanan', 'LayananController@index')->name('layanan.index');
Route::get('/data-master/layanan/add', 'LayananController@create')->name('layanan.create');
Route::post('/data-master/layanan', 'LayananController@store')->name('layanan.store');
Route::get('/data-master/layanan/{id}/edit', 'LayananController@edit')->name('layanan.edit');
Route::post('/data-master/layanan/{id}/update', 'LayananController@update')->name('layanan.update');
Route::get('/data-master/layanan/{id}/delete', 'LayananController@delete')->name('layanan.delete');

Route::get('/asesmen/awal-dewasa/perawat', 'AsesmenController@awalDewasaPerawat')->name('asesmen.awal-dewasa.perawat');


