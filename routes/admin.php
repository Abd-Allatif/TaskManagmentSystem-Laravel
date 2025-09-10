<?php

use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\AdminAuth\PasswordResetController;
use App\Http\Controllers\AdminAuth\RegisteredAdminController;
use App\Http\Controllers\AdminAuth\VerificationController;
use App\Http\Controllers\Managment\AdminController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => 'admin'], function () {
    Route::get('/dashboard', [AdminController::class,'index'])->middleware(['auth:admin', 'verifyEmailAddress'])->name('dashboard');

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
