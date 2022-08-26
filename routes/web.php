<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('/dashboard', App\Http\Controllers\Dash\DashboardController::class);
Route::resource('/monitoring', App\Http\Controllers\Dash\MonitoringController::class);
Route::resource('/nodes', App\Http\Controllers\Dash\NodesController::class);
Route::post('/nodes', [App\Http\Controllers\Dash\NodesController::class, 'storeLabel'])->name('nodes.storeLabel');
Route::get('/nodes-report-ajax/{id}', [App\Http\Controllers\Dash\NodesController::class, 'reportAjax'])->name('nodes.ajax');
Route::resource('/forecast', App\Http\Controllers\Dash\ForecastController::class);
Route::get('/gps-track/{id}', [App\Http\Controllers\Dash\GPSTrackController::class, 'index'])->name('track.index');
Route::post('/gps-track', [App\Http\Controllers\Dash\GPSTrackController::class, 'gpsData'])->name('track.data');
Route::resource('/alerts', App\Http\Controllers\Dash\AlertsController::class);
Route::resource('/settings', App\Http\Controllers\Dash\SettingsController::class);
Route::resource('/users', App\Http\Controllers\Dash\UsersController::class);
Route::resource('/documentation', App\Http\Controllers\Dash\DocumentationController::class);
Auth::routes();