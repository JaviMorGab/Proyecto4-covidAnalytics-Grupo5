<?php

use App\Http\Controllers\AnalyticsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

Route::get('/countries', [AnalyticsController::class, 'getCountries']);
Route::get('/regions', [AnalyticsController::class, 'getRegions']);
Route::get('/entries', [AnalyticsController::class, 'getEntries']);
Route::get('/entries/porfecha/{fecha}', [AnalyticsController::class, 'consultaPaisDia']);
Route::get('/entries/porfecha/{fecha}/porcountries/{countries}', [AnalyticsController::class, 'consultaPaisConcreto']);
Route::get('/entries/porcases/{cases}/pordeaths/{deaths}', [AnalyticsController::class, 'consultasuma']);
Route::get('/entries/porpais/{countriesAndTerritories}', [AnalyticsController::class, 'consultaelpais']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
