<?php

use App\Http\Controllers\Api\V1\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth.custom')->group(function () {
    Route::prefix('/v1')->group(function () {
        Route::get('/events', [EventController::class, 'index'])->name('api.v1.events.index');
        Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('api.v1.events.destroy')->whereNumber('id');
    });
});
