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

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'permission']], function () {
    Route::prefix('keuangan')->group(function () {
        Route::get('/', function () {
            return redirect()->route('dashboard');
        });
        Route::get('/dashboard', 'KeuanganController@index')->name('dashboard');
        Route::get('/dashboard-triwulan', 'TriwulanController@index');
        // perencanaan
        Route::get('/perencanaan', 'PerencanaanController@index')->name('perencanaan.index');
        Route::get('/perencanaan/create', 'PerencanaanController@create')->name('perencanaan.create');
        Route::post('/perencanaan/store', 'PerencanaanController@store')->name('perencanaan.store');
        Route::get('/perencanaan/{perencanaan}/edit', 'PerencanaanController@edit')->name('perencanaan.edit');
        Route::patch('/perencanaan/{perencanaan}/update', 'PerencanaanController@update')->name('perencanaan.update');
        Route::delete('/perencanaan/destroy/{perencanaan}', 'PerencanaanController@destroy')->name('perencanaan.destroy');

        // subPerencanaan
        Route::get('/perencanaan/{perencanaan}/sub_perencanaan', 'SubPerencanaanController@index')->name('perencanaan.sub_index');
        Route::get('/perencanaan/{perencanaan}/sub_perencanaan/show', 'SubPerencanaanController@show')->name('perencanaan.show');
        Route::post('/perencanaan/{perencanaan}/subPerencanaan/store', 'SubPerencanaanController@store')->name('subPerencanaan.store');

        // realisasi
        Route::get('/realisasi', 'RealisasiController@index')->name('realisasi.index');
        Route::get('realisasi/create', 'RealisasiController@create')->name('realisasi.create');
        Route::get('/realisasi/{perencanaan}/show', 'RealisasiController@show')->name('realisasi.show');
        Route::get('/realisasi/edit/{id}', 'RealisasiController@edit')->name('realisasi.edit');
        Route::patch('realisasi/update/{id}', 'RealisasiController@update')->name('realisasi.update');
        Route::post('/realisasi/store', 'RealisasiController@store')->name('realisasi.store');
        Route::delete('/realisasi/destroy/{realisasi}', 'RealisasiController@destroy')->name('realisasi.destroy');

        // laporan
        Route::get('/laporan', 'LaporanController@index')->name('laporan.index');
        Route::get('/laporan/show-laporan', 'LaporanController@show_laporan')->name('show_laporan');
        Route::get('/laporan/cetak-laporan', 'LaporanController@cetak_laporan')->name('laporan.cetak_laporan');
    });
});
