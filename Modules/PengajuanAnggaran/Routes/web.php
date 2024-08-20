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


Route::group(['middleware' => ['auth']], function () {
    Route::prefix('pengajuananggaran')->group(function () {
        Route::resource('/pengajuan', 'PengajuanAnggaranController');
        Route::get('/create-detail-rab/{id}', 'PengajuanAnggaranController@createDetail')->name('detailRab.create');
        Route::post('/create-detail-rab/{id}', 'PengajuanAnggaranController@storeDetail')->name('detailRab.store');
        Route::get('/edit-detail-rab/{id}', 'PengajuanAnggaranController@editDetail')->name('detailRab.edit');
        Route::patch('/update-detail-rab/{id}', 'PengajuanAnggaranController@updateDetail')->name('detailRab.update');
        Route::get('/delete-detail-rab/{id}', 'PengajuanAnggaranController@deleteDetail')->name('detailRab.delete');
        Route::get('/approve-rab/{id}', 'PengajuanAnggaranController@approveRab')->name('detailRab.approve');


        Route::resource('/iku', 'IkuController');
        Route::get('/modal-edit-iku/{id}', 'IkuController@modalEdit')->name('modalEditIku');
        Route::post('/add-data-iku/{id}', 'IkuController@storeDataIku');
        Route::post('/edit-data-iku/{id}', 'IkuController@editDataIku');
        Route::get('/delete-data-iku/{id}', 'IkuController@deleteDataIku');
        Route::get('/history-iku', 'IkuController@historyIku')->name('historyIku');
        Route::get('/save-iku', 'IkuController@saveIku')->name('saveIku');
        Route::get('/detail-history-iku/{date}', 'IkuController@detailHistory')->name('detailHistoryIku');


        Route::resource('/sbm', 'SbmController');
        Route::get('/modal-edit-sbm/{id}', 'SbmController@modalEdit')->name('modalEditSbm');
        Route::post('/edit-data-sbm/{id}', 'SbmController@editDataSbm');
        Route::post('/add-data-sbm/{id}', 'SbmController@storeDataSbm');
        Route::get('/delete-data-sbm/{id}', 'SbmController@deleteDataSbm');
        Route::get('/history-sbm', 'SbmController@historySbm')->name('historySbm');
        Route::get('/save-sbm', 'SbmController@saveSbm')->name('saveSbm');
        Route::get('/detail-history-sbm/{date}', 'SbmController@detailHistory')->name('detailHistorySbm');
    });
});
