<?php

namespace App\Providers;

use App\Mail\VerficationMail;
use App\Repositories\Admin\RolesRepository;
use App\Repositories\Admin\UserRepository;
use App\Repositories\AdminRepository;
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

        $this->app->bind(AdminRepository::class,function($app){
            return new AdminRepository;
        });

        $this->app->bind(UserRepository::class,function($app){
            return new UserRepository;
        });

        $this->app->bind(RolesRepository::class,function($app){
            return new RolesRepository;
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
