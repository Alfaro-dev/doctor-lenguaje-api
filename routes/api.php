<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;

Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', 'logout');
});
