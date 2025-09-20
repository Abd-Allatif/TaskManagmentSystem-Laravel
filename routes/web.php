<?php

use App\Http\Controllers\Managment\CategoryController;
use App\Http\Controllers\Managment\StatusController;
use App\Http\Controllers\Managment\SubTaskController;
use App\Http\Controllers\Managment\TaskController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $user = Auth::user();
    return view('welcome', ['user' => $user]);
});

Route::middleware(['auth', 'verifyEmailAddress'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth:web', 'verifyEmailAddress'])->group(function () {
    Route::get('/tasks', [TaskController::class, 'getTasks'])->name('getAllTasks');
    Route::post('/tasks/searchTask', [TaskController::class, 'searchTask'])->name('searchTask');

    Route::get('/tasks/about_task/{taskid}', [TaskController::class, 'showClickedTask'])->name('getClickedTask');

    Route::get('/tasks/createTask', [TaskController::class, 'ShowcreateTask'])->name('createTaskUser');
    Route::post('/tasks/create_new_task', [TaskController::class, 'createTask'])->name('createNewTask');

    Route::get('/tasks/show_edit_task/{taskId}', [TaskController::class, 'showEditPage'])->name('showEditPage');
    Route::put('/tasks/edit_task/{taskId}', [TaskController::class, 'editTask'])->name('editTask');

    Route::post('/tasks/create_subtask/{taskId}', [SubTaskController::class, 'createSubTask'])->name('createSubTask');

    Route::post('/tasks/start_task/{taskId}', [StatusController::class, 'startTask'])->name('StartTask');
    Route::post('/tasks/end_task/{taskId}', [StatusController::class, 'endTask'])->name('EndTask');
});

route::get('/category/{categoryId}', [CategoryController::class, 'getClickedCategory'])->name('getClickedCategory');


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';

