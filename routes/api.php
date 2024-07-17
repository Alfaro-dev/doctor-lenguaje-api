<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LenguajeController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\LessonController;

use App\Http\Controllers\OpenAIController;

Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    //
    Route::post('/logout', [AuthController::class, 'logout']);   
    
    // 
    Route::apiResource('lenguajes', LenguajeController::class);
    Route::apiResource('levels', LevelController::class);
    Route::apiResource('modules', ModuleController::class);
    Route::apiResource('lessons', LessonController::class);
});

Route::post('/generate-text', [OpenAIController::class, 'generate']);

