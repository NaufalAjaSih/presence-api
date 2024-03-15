<?php

use App\Http\Controllers\AuthCotroller;
use App\Http\Controllers\PresenceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthCotroller::class, 'login']);
Route::post('/checkin', [PresenceController::class, 'recordCheckIn'])->middleware('auth:sanctum');
Route::post('/distance', [PresenceController::class, 'userDistance'])->middleware('auth:sanctum');
