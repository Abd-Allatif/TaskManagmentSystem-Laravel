<?php

namespace App\Providers;

use App\Mail\VerficationMail;
use App\Repositories\CategoryRepository;
use App\Repositories\TaskRepository;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TaskRepository::class,function($app){
            return new TaskRepository;
        });

        $this->app->bind(CategoryRepository::class,function($app){
            return new CategoryRepository;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
