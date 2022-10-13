<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

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

Route::prefix('/events')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('events');
    Route::get('/create', [EventController::class, 'create'])->name('event.create');
    Route::get('/{event}', [EventController::class, 'show'])->name('event.show');
    Route::post('/', [EventController::class, 'store'])->name('event.store');
    Route::get('/{event}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::put('/{event}', [EventController::class, 'update'])->name('event.update');
    Route::delete('/{event}', [EventController::class, 'destroy'])->name('event.destroy');
});
