<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Alert;
use App\Models\NodesReport;

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
Route::get('/alert', function () {
    $alerts = Alert::all();
    $result = [];
    foreach ($alerts as $alert) {
        $result[$alert->variable] = $alert['active'];
    }
    return $result;
});
Route::post('/report', [App\Http\Controllers\Dash\NodesController::class, 'store']);
Route::post('/reportTest', [App\Http\Controllers\Dash\NodesController::class, 'reportTest']);
Route::get('/nodes_report', [App\Http\Controllers\Dash\NodesController::class, 'nodes_report']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});