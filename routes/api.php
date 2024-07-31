<?php

use App\Http\Controllers\Api\FanController;
use App\Http\Controllers\Api\KlubController;
use App\Http\Controllers\Api\LigaController;
use App\Http\Controllers\Api\PemainController;
use App\Http\Controllers\Api\AuthController;
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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('Liga', [LigaController::class, 'index']);
// Route::get('Liga/{id}', [LigaController::class, 'show']);
// Route::post('Liga', [LigaController::class, 'store']);
// Route::put('Liga/{id}', [LigaController::class, 'update']);
// Route::delete('Liga/{id}', [LigaController::class, 'destroy']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::resource('Liga', LigaController::class)->except(['create', 'edit']);
    Route::resource('Klub', KlubController::class)->except(['create', 'edit']);
    Route::resource('Pemain', PemainController::class)->except(['create', 'edit']);
    Route::resource('Fan', FanController::class)->except(['create', 'edit']);

});

//auth route
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
