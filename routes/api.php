<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PresenceController;
use App\Models\Presence;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::post('/checkin', [PresenceController::class, 'recordCheckIn'])->middleware('auth:sanctum');

Route::get('/get-weekly', [PresenceController::class, 'getWeekly'])->middleware('auth:sanctum');
Route::get('/get-today', [PresenceController::class, 'getToday'])->middleware('auth:sanctum');
Route::get('/get-monthly', [PresenceController::class, 'getMonthly'])->middleware('auth:sanctum');


Route::get('/distance', [PresenceController::class, 'userDistance'])->middleware('auth:sanctum');
Route::get('/agenda', [AgendaController::class, 'getByDate'])->middleware('auth:sanctum');

Route::post('/leave-request', [LeaveController::class, 'store'])->middleware('auth:sanctum');