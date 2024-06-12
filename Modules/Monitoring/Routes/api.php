<?php

use Illuminate\Http\Request;
use Modules\Monitoring\Http\Controllers\LaporanController;
use Modules\Monitoring\Http\Controllers\MonitoringController;

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

Route::middleware('auth:api')->get('/monitoring', function (Request $request) {
    return $request->user();
});

// Route::get('/serapan-anggaran', [MonitoringController::class, 'getDataSerapan']);

Route::get('/data', [LaporanController::class, 'getData']);
Route::get('/program', [LaporanController::class, 'getProgram']);
Route::get('/kegiatan', [LaporanController::class, 'getKegiatan']);

