<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::apiResource('tasks', TaskController::class);

// Тестовый маршрут для проверки
Route::get('/test', function () {
    return response()->json([
        'message' => 'API работает!',
        'status' => 'ok',
        'timestamp' => now(),
    ]);
});