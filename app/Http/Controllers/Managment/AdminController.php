<?php

namespace App\Http\Controllers\Managment;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Repositories\CategoryRepository;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected TaskRepository $taskRepository;
    protected CategoryRepository $categoryRepository;

    public function __construct(TaskRepository $taskRepository, CategoryRepository $categoryRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->categoryRepository = $categoryRepository;
    }
    public function index()
    {   
        $users = User::with('tasks')->get();
        $tasks = $this->taskRepository->getAllTasksWithUsers();
        $categories = $this->categoryRepository->getAllCategoriesWithTasks();

        return view('dashboard', ['users' => $users,'tasks' => $tasks,'categories' => $categories]);
    }
}
