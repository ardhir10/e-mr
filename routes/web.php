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
// --- LOGIN AREA

Route::get('/', 'AuthController@showFormLogin')->name('login');
Route::get('login', 'AuthController@showFormLogin')->name('login');
Route::post('login', 'AuthController@login');
Route::get('register', 'AuthController@showFormRegister')->name('register');
Route::post('register', 'AuthController@register');
Route::get('logout', 'AuthController@logout')->name('logout');


Route::middleware('auth')->group(function () {

    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/rekam-medis', 'RekamMedisController@index')->name('rekam-medis.index');
    Route::get('/rekam-medis/datatables', 'RekamMedisController@getRekamMedis')->name('rekam-medis.datatables');
    Route::get('/rawat-medis/detail/{from}/{no}/{kd_dokter?}/{kd_reg?}', 'RekamMedisController@detail')->name('rekam-medis.detail');
    Route::post('/rawat-medis/detail/{from}/{no}/{kd_dokter?}/{kd_reg?}', 'RekamMedisController@detailFiltered')->name('rekam-medis.detail');

    Route::get('/rawat-jalan', 'RawatJalanController@index')->name('rawat-jalan.index');
    Route::get('/rawat-inap', 'RawatInapController@index')->name('rawat-inap.index');

    // --- CPPT

    Route::get('/cppt/tambah/{from}/{id}/{kd_dokter?}/{kd_reg?}', 'CpptController@create')->name('cppt.create');
    Route::post('/cppt/simpan/{id}', 'CpptController@store')->name('cppt.store');
    Route::get('/cppt/detail/{from}/{id}', 'CpptController@detail')->name('cppt.detail');
    Route::get('/cppt/verified/{id}', 'CpptController@verified')->name('cppt.verified');
    Route::get('/cppt/unverified/{id}', 'CpptController@unverified')->name('cppt.unverified');
    Route::post('/cppt/update/{id}', 'CpptController@update')->name('cppt.update');


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


    // --- USER SETUP
    Route::get('/data-master/user/assign/{id}', 'UserController@asignRole')->name('user.asign');
    Route::get('/data-master/user', 'UserController@index')->name('user.index');
    Route::get('/data-master/user/add', 'UserController@create')->name('user.create');
    Route::post('/data-master/user', 'UserController@store')->name('user.store');
    Route::get('/data-master/user/{id}/edit', 'UserController@edit')->name('user.edit');
    Route::post('/data-master/user/{id}/update', 'UserController@update')->name('user.update');
    Route::get('/data-master/user/{id}/delete', 'UserController@delete')->name('user.delete');

    // --- ROLE SETUP
    Route::get('/data-master/role', 'RoleController@index')->name('role.index');
    Route::get('/data-master/role/add', 'RoleController@create')->name('role.create');
    Route::post('/data-master/role', 'RoleController@store')->name('role.store');
    Route::get('/data-master/role/{id}/edit', 'RoleController@edit')->name('role.edit');
    Route::post('/data-master/role/{id}/update', 'RoleController@update')->name('role.update');
    Route::get('/data-master/role/{id}/delete', 'RoleController@delete')->name('role.delete');

    // --- LIST DOKTER
    Route::get('/data-master/dokter', 'DokterController@index')->name('dokter.index');


    // --- RIWAYAT LABORATORIUM
    Route::get('/riwayat/laboratorium','RiwayatLaboratoriumController@index')->name('riwayat.laboratorium.index');
    Route::post('/riwayat/laboratorium','RiwayatLaboratoriumController@index')->name('riwayat.laboratorium.search');

    // --- RIWAYAT RADIOLOGI
    Route::get('/riwayat/radiologi','RiwayatRadiologiController@index')->name('riwayat.radiologi.index');
    Route::post('/riwayat/radiologi','RiwayatRadiologiController@index')->name('riwayat.radiologi.search');

});


// --- ASESMEN PERAWAT
Route::get('/asesmen/awal-dewasa/perawat/{from}/{type}/{no}/{kd_dokter?}/{kd_reg?}', 'AsesmenController@awalPerawat')->name('asesmen.awal-dewasa.perawat');
Route::get('/asesmen/awal-dewasa/perawat-detail/{type}/{id}', 'AsesmenController@detailPerawat')->name('asesmen.detail.perawat');
Route::post('/asesmen/awal-dewasa/perawat', 'AsesmenController@store')->name('asesmen-awal-perawat.store');
Route::post('/asesmen/awal-dewasa/perawat/{id}/update', 'AsesmenController@update')->name('asesmen-awal-perawat.update');
Route::get('/asesmen/awal-dewasa/verified/{id}', 'AsesmenController@verified')->name('asesmen-perawat.verified');
Route::get('/asesmen/awal-dewasa/unverified/{id}', 'AsesmenController@unverified')->name('asesmen-perawat.unverified');


// --- ASESMEN DOKTER
Route::get('/asesmen/awal-dewasa/dokter/{from}/{type}/{no}/{kd_dokter?}/{kd_reg?}', 'AsesmenDokterController@create')->name('asesmen.awal-dewasa.dokter');
Route::post('/asesmen/awal-dewasa/dokter', 'AsesmenDokterController@store')->name('asesmen-awal-dokter.store');
Route::get('/asesmen/awal-dewasa/dokter-detail/{type}/{id}', 'AsesmenDokterController@detail')->name('asesmen.detail.dokter');
Route::get('/asesmen/awal-dewasa/dokter/verified/{id}', 'AsesmenDokterController@verified')->name('asesmen-dokter.verified');
Route::get('/asesmen/awal-dewasa/dokter/unverified/{id}', 'AsesmenDokterController@unverified')->name('asesmen-dokter.unverified');
Route::post('/asesmen/awal-dewasa/dokter/{id}/update', 'AsesmenDokterController@update')->name('asesmen-awal-dokter.update');


// --- ASESMEN BIDAN
Route::get('/asesmen/awal-bidan/dokter/{from}/{type}/{no}/{kd_dokter?}/{kd_reg?}', 'AsesmenBidanController@create')->name('asesmen.awal-bidan.dokter');
Route::post('/asesmen/awal-dewasa/dokter-bidan', 'AsesmenBidanController@store')->name('asesmen-awal-bidan-dokter.store');
Route::get('/asesmen/awal-dewasa/dokter-bidan-detail/{type}/{id}', 'AsesmenBidanController@detail')->name('asesmen.detail.dokterbidan');
Route::get('/asesmen/awal-dewasa/dokter-bidan/verified/{id}', 'AsesmenBidanController@verified')->name('asesmen-dokter-bidan.verified');
Route::get('/asesmen/awal-dewasa/dokter-bidan/unverified/{id}', 'AsesmenBidanController@unverified')->name('asesmen-dokter-bidan.unverified');
Route::post('/asesmen/awal-dewasa/dokter-bidan/{id}/update', 'AsesmenBidanController@update')->name('asesmen-awal-dokter-bidan.update');

Route::get('/geticd', 'AsesmenDokterController@getIcd')->name('');


