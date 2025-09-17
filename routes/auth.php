<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:web')->group(function () {

    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [PasswordResetController::class, 'showResetPage'])
        ->name('password.reset');

    Route::post('reset-password', [PasswordResetController::class, 'resetPassword'])
        ->name('password.resetPass');
});

Route::middleware('auth:web')->group(function () {
    // Custom Verification Methods
    Route::get('/email/verify', [VerificationController::class, 'noticePageView'])
        ->middleware('auth')
        ->name('verification.notice');

    Route::post('/email/send', [VerificationController::class, 'sendVerificationEmail'])
        ->middleware('auth')
        ->name('verification.send');

    Route::get('/email/verify/{id}', [VerificationController::class, 'verifyEmail'])
        ->name('verification.verify');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
