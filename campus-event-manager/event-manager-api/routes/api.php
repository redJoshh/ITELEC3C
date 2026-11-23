<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/currentUser', [AuthController::class, 'currentUser']);

    Route::get('/events/archived', [EventController::class, 'archivedEvents']);
    Route::apiResource('events', EventController::class);

    Route::post('/events/{event}/restore', [EventController::class, 'restore'])
        ->withTrashed();
    Route::delete('/events/{event}/forcedelete', [EventController::class, 'forceDelete'])
        ->withTrashed();
});