<?php

use App\Http\Controllers\Managment\CategoryController;
use App\Http\Controllers\Managment\StatusController;
use App\Http\Controllers\Managment\SubTaskController;
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

Route::middleware(['auth', 'verifyEmailAddress'])->group(function () {
    Route::get('/tasks/{userid}', [TaskController::class, 'getTasks'])->name('getAllTasks');
    Route::post('/tasks/searchTask/{userId}', [TaskController::class, 'searchTask'])->name('searchTask');

    Route::get('/tasks/about_task/{taskid}/{userId}', [TaskController::class, 'showClickedTask'])->name('getClickedTask');

    Route::get('/tasks/createTask/{userId}', [TaskController::class, 'ShowcreateTask'])->name('createTask');
    Route::post('/tasks/create_new_task/{userId}', [TaskController::class, 'createTask'])->name('createNewTask');

    Route::get('/tasks/show_edit_task/{taskId}/{userId}', [TaskController::class, 'showEditPage'])->name('showEditPage');
    Route::put('/tasks/edit_task/{taskId}/{userId}', [TaskController::class, 'editTask'])->name('editTask');

    Route::post('/tasks/create_subtask/{taskId}', [SubTaskController::class, 'createSubTask'])->name('createSubTask');

    Route::post('/tasks/start_task/{taskId}/{userId}', [StatusController::class, 'startTask'])->name('StartTask');
    Route::post('/tasks/end_task/{taskId}/{userId}', [StatusController::class, 'endTask'])->name('EndTask');
});

route::get('/category/{categoryId}/user/{userId}', [CategoryController::class, 'getClickedCategory'])->name('getClickedCategory');

require __DIR__ . '/auth.php';
