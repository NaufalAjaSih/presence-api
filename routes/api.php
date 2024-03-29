<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PresenceController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/checkin', [PresenceController::class, 'recordCheckIn'])->middleware('auth:sanctum');
Route::get('/distance', [PresenceController::class, 'userDistance'])->middleware('auth:sanctum');
Route::get('/agenda', [AgendaController::class, 'getByDate'])->middleware('auth:sanctum');
