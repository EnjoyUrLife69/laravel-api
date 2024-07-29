<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LigaController;

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

Route::get('Liga', [LigaController::class, 'index']);
Route::get('Liga/{id}', [LigaController::class, 'show']);
Route::post('Liga', [LigaController::class, 'store']);
Route::put('Liga/{id}', [LigaController::class, 'update']);
Route::delete('Liga/{id}', [LigaController::class, 'destroy']);
