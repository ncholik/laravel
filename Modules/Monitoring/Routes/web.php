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

Route::prefix('monitoring')->group(function() {
    Route::get('/', 'MonitoringController@index');

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
        Route::get('/realisasi/{perencanaan}', 'RealisasiController@sub_index')->name('realisasi.sub_index');
        Route::get('/realisasi/{perencanaan}/show', 'RealisasiController@show')->name('realisasi.show');
        Route::get('/realisasi/create', 'RealisasiController@create')->name('realisasi.create');
        Route::get('/realisasi/store', 'RealisasiController@store')->name('realisasi.store');
        Route::get('/realisasi/destroy/{realisasi}', 'RealisasiController@destroy')->name('realisasi.destroy');

        // laporan bulanan
        Route::get('/laporan_bulanan', 'LaporanController@index_bulanan')->name('laporan_bulanan.index');

        // laporan triwulan
        Route::get('/laporan_triwulan', 'LaporanController@index_triwulan')->name('laporan_triwulan.index');
});
