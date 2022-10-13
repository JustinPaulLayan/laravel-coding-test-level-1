<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;

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

Route::prefix('v1/events')->group(function () {
    Route::post('/', [EventController::class, 'store']);
    Route::get('/', [EventController::class, 'events']);
    Route::get('/active-events', [EventController::class, 'activeEvents']);
    Route::get('/{event}', [EventController::class, 'event']);
    Route::put('/{id}', [EventController::class, 'update']);
    Route::patch('/{event}', [EventController::class, 'patch']);
    Route::delete('/{event}', [EventController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});