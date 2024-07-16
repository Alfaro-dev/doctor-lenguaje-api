<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\AuthService;
use App\Services\AuthServiceInterface;
use App\Services\UserService;
use App\Services\UserServiceInterface;
use App\Services\LenguajeService;
use App\Services\LenguajeServiceInterface;
use App\Services\LessonService;
use App\Services\LessonServiceInterface;
use App\Services\LevelService;
use App\Services\LevelServiceInterface;
use App\Services\ModuleService;
use App\Services\ModuleServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(LenguajeServiceInterface::class, LenguajeService::class);
        $this->app->bind(LevelServiceInterface::class, LevelService::class);
        $this->app->bind(ModuleServiceInterface::class, ModuleService::class);
        $this->app->bind(LessonServiceInterface::class, LessonService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
