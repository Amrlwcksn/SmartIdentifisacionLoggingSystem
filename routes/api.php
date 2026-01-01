<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\TelegramWebhookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/scan-rfid', [AttendanceController::class, 'scan']);
Route::post('/telegram/webhook', [TelegramWebhookController::class, 'handle']);
Route::post('/internal/link-telegram', [TelegramWebhookController::class, 'linkFromFlask']);
