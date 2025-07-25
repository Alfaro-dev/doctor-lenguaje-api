<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LearningProgressController;
use App\Http\Controllers\LenguajeController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\LessonController;

use App\Http\Controllers\OpenAIController;
use Illuminate\Support\Facades\Auth;

Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    //
    Route::controller(AuthController::class)->group(function(){
        Route::get('me', 'me');
        Route::post('logout', 'logout');
    });

    //
    Route::get('/learning-progress', [LearningProgressController::class, 'index']);

    //
    Route::apiResource('lenguajes', LenguajeController::class);
    Route::apiResource('levels', LevelController::class);
    Route::apiResource('modules', ModuleController::class);
    Route::apiResource('lessons', LessonController::class);

    //
});

Route::controller(OpenAIController::class)->group(function(){
    Route::post('generate-text', 'generate');
    Route::post('analyze-audio', 'analyzeAudio');
});
