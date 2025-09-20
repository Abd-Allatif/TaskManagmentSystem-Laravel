<?php

namespace App\Providers;

use App\Http\Controllers\Managment\Admin\AdminCategoryController;
use App\Mail\VerficationMail;
use App\Repositories\Admin\AdminCategoryRepository;
use App\Repositories\Admin\AdminTaskRepository;
use App\Repositories\Admin\RolesRepository;
use App\Repositories\Admin\UserRepository;
use App\Repositories\AdminRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TaskRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Repositories\Admin\AdminManagmentRepository;
use App\Repositories\Admin\AdminProfileRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->bind(AuthenticatedSessionController::class,function($app){
        //     return new AuthenticatedSessionController;
        // });

        // $this->app->bind(TaskRepository::class,function($app){
        //     return new TaskRepository;
        // });

        // $this->app->bind(CategoryRepository::class,function($app){
        //     return new CategoryRepository;
        // });

        // $this->app->bind(AdminRepository::class,function($app){
        //     return new AdminRepository;
        // });

        // $this->app->bind(UserRepository::class,function($app){
        //     return new UserRepository;
        // });

        // $this->app->bind(RolesRepository::class,function($app){
        //     return new RolesRepository;
        // });

        // $this->app->bind(AdminCategoryRepository::class,function($app){
        //     return new AdminCategoryRepository;
        // });
        
        // $this->app->bind(AdminTaskRepository::class,function($app){
        //     return new AdminTaskRepository;
        // });

        // $this->app->bind(AdminManagmentRepository::class,function($app){
        //     return new AdminManagmentRepository;
        // });

        // $this->app->bind(AdminProfileRepository::class,function($app){
        //     return new AdminProfileRepository;
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
