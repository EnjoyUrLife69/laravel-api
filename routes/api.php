<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LigaController;
use App\Http\Controllers\Api\KlubController;
use App\Http\Controllers\Api\PemainController;
use App\Http\Controllers\Api\FanController;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('Liga', [LigaController::class, 'index']);
// Route::get('Liga/{id}', [LigaController::class, 'show']);
// Route::post('Liga', [LigaController::class, 'store']);
// Route::put('Liga/{id}', [LigaController::class, 'update']);
// Route::delete('Liga/{id}', [LigaController::class, 'destroy']);

Route::resource('Liga', LigaController::class)->except(['create', 'edit']);
Route::resource('Klub', KlubController::class)->except(['create', 'edit']);
Route::resource('Pemain', PemainController::class)->except(['create', 'edit']);
Route::resource('Fan', FanController::class)->except(['create', 'edit']);