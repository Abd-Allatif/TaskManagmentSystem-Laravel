<?php

use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\AdminAuth\PasswordResetController;
use App\Http\Controllers\AdminAuth\RegisteredAdminController;
use App\Http\Controllers\AdminAuth\VerificationController;
use App\Http\Controllers\Managment\Admin\AdminCategoryController;
use App\Http\Controllers\Managment\Admin\AdminController;
use App\Http\Controllers\Managment\Admin\AdminManagmentController;
use App\Http\Controllers\Managment\Admin\AdminProfileController;
use App\Http\Controllers\Managment\Admin\AdminTaskController;
use App\Http\Controllers\Managment\Admin\RolesController;
use App\Http\Controllers\Managment\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => 'admin'], function () {
    Route::middleware(['auth:admin', 'verifyEmailAddress'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        Route::group(['prefix' => 'user'], function () {
            Route::get('/managment', [UserController::class, 'userManagment'])->name('userManagment');

            Route::get('/create', [UserController::class, 'userCreateShow'])->name('userCreateShow');
            Route::post('/create-user', [UserController::class, 'userCreate'])->name('userCreate');

            Route::get('/edit/{userId}', [UserController::class, 'userEditShow'])->name('userEditShow');
            Route::put('/edit-user/{userId}', [UserController::class, 'userEdit'])->name('userEdit');

            Route::delete('/delete-user/{userId}', [UserController::class, 'deleteUser'])->name('deleteUser');
        });

        Route::group(['prefix' => 'roles'], function () {
            Route::get('managment', [RolesController::class, 'rolesPage'])->name('rolesManagment');

            Route::get('/create', [RolesController::class, 'showCreatePage'])->name('roleCreatePage');
            Route::post('/create-role', [RolesController::class, 'createRole'])->name('createRole');

            Route::get('/edit/{roleId}', [RolesController::class, 'showEditPage'])->name('roleEditPage');
            Route::put('/edit-role/{roleId}', [RolesController::class, 'editRole'])->name('editRole');

            Route::delete('/delete-role/{roleId}', [RolesController::class, 'deleteRole'])->name('deleteRole');
        });

        Route::group(['prefix' => 'categories'], function () {
            Route::get('managment', [AdminCategoryController::class, 'categoryPage'])->name('categoryManagment');

            Route::get('/create', [AdminCategoryController::class, 'createCategoryPage'])->name('categoryCreatePage');
            Route::post('/create-category', [AdminCategoryController::class, 'createCategory'])->name('createCategory');

            Route::get('/edit/{categoryId}', [AdminCategoryController::class, 'editCategoryPage'])->name('categoryEditPage');
            Route::put('/edit-category/{categoryId}', [AdminCategoryController::class, 'editCategory'])->name('editcategory');

            Route::delete('/delete-category/{categoryId}', [AdminCategoryController::class, 'deleteCategory'])->name('deleteCategory');
        });

        Route::group(['prefix' => 'tasks'], function () {
            Route::get('managment', [AdminTaskController::class, 'taskPage'])->name('taskManagment');

            Route::get('/create', [AdminTaskController::class, 'createTaskPage'])->name('taskCreatePage');
            Route::post('/create-task', [AdminTaskController::class, 'createTask'])->name('createTask');

            Route::get('/edit/{taslId}', [AdminTaskController::class, 'editTaskPage'])->name('taskEditPage');
            Route::put('/edit-task/{taskId}', [AdminTaskController::class, 'editTask'])->name('editTaskAdmin');

            Route::delete('/delete-task/{taskId}', [AdminTaskController::class, 'deleteTask'])->name('deleteTask');
        });

        Route::group(['prefix' => 'admin-managment'], function () {
            Route::get('managment', [AdminManagmentController::class, 'adminPage'])->name('adminManagment');

            Route::get('/create', [AdminManagmentController::class, 'createAdminPage'])->name('adminCreatePage');
            Route::post('/create-admin', [AdminManagmentController::class, 'createAdmin'])->name('createAdmin');

            Route::get('/edit/{adminId}', [AdminManagmentController::class, 'editAdminPage'])->name('adminEditPage');
            Route::put('/edit-admin/{adminId}', [AdminManagmentController::class, 'editAdmin'])->name('editAdmin');

            Route::delete('/delete-admin/{adminId}', [AdminManagmentController::class, 'deleteAdmin'])->name('deleteAdmin');
        });

        Route::group(['prefix' => 'profile'],function (){
            Route::get('my-profile',[AdminProfileController::class,'profilePage'])->name('adminProfile');

            Route::put('edit-admin-profile',[AdminProfileController::class,'editProfile'])->name('edit.adminProfile');
        });
    });

    Route::middleware('guest:admin')->group(function () {
        Route::get('admin-register', [RegisteredAdminController::class, 'create'])
            ->name('admin-register');

        Route::post('adminRegister', [RegisteredAdminController::class, 'store'])->name('adminRegister');

        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('admin-login');

        Route::post('adminLogin', [AuthenticatedSessionController::class, 'store'])->name('adminLogin');

        Route::get('forgot-password', [PasswordResetController::class, 'create'])
            ->name('admin-password.request');

        Route::post('forgot-password', [PasswordResetController::class, 'store'])
            ->name('admin-password.email');

        Route::get('reset-password/{token}', [PasswordResetController::class, 'showResetPage'])
            ->name('admin-password.reset');

        Route::post('reset-password', [PasswordResetController::class, 'resetPassword'])
            ->name('admin-password.resetPass');
    });

    Route::middleware('auth:admin')->group(function () {
        // Custom Verification Methods
        Route::get('admin/email/verify', [VerificationController::class, 'noticePageView'])
            ->name('admin-verification.notice');

        Route::post('admin/email/send', [VerificationController::class, 'sendVerificationEmail'])
            ->name('admin-verification.send');

        Route::get('admin/email/verify/{id}', [VerificationController::class, 'verifyEmail'])
            ->name('admin-verification.verify');

        Route::post('admin-logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('admin-logout');
    });
});
