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

Route::group(['middleware' => ['auth', 'permission']], function () {
    Route::prefix('keuanganmpa')->group(function () {
        Route::get('/', function () {
            return redirect()->route('dashboard');
        });
        Route::group(['middleware' => ['check_user']], function () {
            Route::get('/dashboard-bulanan', 'KeuanganBulananController@index')->name('dashboard');
            Route::get('/dashboard-triwulan', 'KeuanganTriwulanController@index')->name('dashboard_triwulan');
        });

        // subPerencanaan
        Route::group(['middleware' => ['check_user']], function () {
            Route::get('/perencanaan/{perencanaan}/sub_perencanaan', 'SubPerencanaanController@index')->name('perencanaan.sub_index');
            Route::get('/perencanaan/{perencanaan}/sub_perencanaan/show', 'SubPerencanaanController@show')->name('perencanaan.show');
            Route::post('/perencanaan/{perencanaan}/subPerencanaan/store', 'SubPerencanaanController@store')->name('subPerencanaan.store');
        });

        Route::group(['middleware' => ['check_user']], function () {
            // realisasi
            Route::get('/realisasi', 'RealisasiController@index')->name('realisasi.index');
            Route::get('realisasi/create', 'RealisasiController@create')->name('realisasi.create');
            Route::get('/realisasi/show/{perencanaan}', 'RealisasiController@show')->name('realisasi.show');
            Route::get('/realisasi/edit/{id}', 'RealisasiController@edit')->name('realisasi.edit');
            Route::patch('realisasi/update/{id}', 'RealisasiController@update')->name('realisasi.update');
            Route::post('/realisasi/store', 'RealisasiController@store')->name('realisasi.store');
            Route::delete('/realisasi/destroy/{realisasi}', 'RealisasiController@destroy')->name('realisasi.destroy');
        });

        // laporan
        Route::get('/laporan', 'LaporanController@index')->name('laporan.index');
        Route::post('/laporan/cetak_pdf', 'LaporanController@cetakPDF')->name('cetak_pdf');
        Route::get('/laporan/cetak_excel', 'LaporanController@cetakExcel')->name('cetak_excel');
        Route::post('/laporan/generate-laporan', 'LaporanController@generate_laporan')->name('laporan.generate');
        Route::get('/laporan/show-pdf/{filename}', 'LaporanController@show_pdf')->name('laporan.show_pdf');
        Route::post('/laporan/reset', 'LaporanController@reset')->name('laporan.reset');
    });
});
