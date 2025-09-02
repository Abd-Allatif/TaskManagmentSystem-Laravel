<?php

use App\Http\Controllers\Managment\TaskController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verifyEmailAddress'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/tasks/{userid}',[TaskController::class,'getTasks'])->name('getAllTasks');
Route::get('/tasks/about_task/{taskid}',[TaskController::class,'showClickedTask'])->name('getClickedTask');
Route::post('/tasks/searchTask/{userId}',[TaskController::class,'searchTask'])->name('searchTask');

require __DIR__.'/auth.php';
