<?php

namespace App\Http\Controllers\Managment;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Repositories\AdminRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected TaskRepository $taskRepository;
    protected CategoryRepository $categoryRepository;
    protected AdminRepository $adminRepository;

    public function __construct(TaskRepository $taskRepository, CategoryRepository $categoryRepository, AdminRepository $adminRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->categoryRepository = $categoryRepository;
        $this->adminRepository = $adminRepository;
    }

    public function index()
    {
        $users = User::with('tasks')->get();
        $tasks = $this->adminRepository->getAllTasksWithUsers();
        $categories = $this->categoryRepository->getAllCategoriesWithTasks();

        $deadlineTasks = $this->adminRepository->getDeadlineTasks();

        return view('dashboard', ['users' => $users, 'tasks' => $tasks, 'categories' => $categories, 'deadlineTasks' => $deadlineTasks]);
    }

    public function adminManagmentView()
    {
        $users = User::with('tasks')->get();
        $tasks = $this->adminRepository->getAllTasksWithUsers();
        $categories = $this->categoryRepository->getAllCategoriesWithTasks();

        $deadlineTasks = $this->adminRepository->getDeadlineTasks();

        return view('pages.admin.adminManagmentView', ['users' => $users, 'tasks' => $tasks, 'categories' => $categories, 'deadlineTasks' => $deadlineTasks]);
    }

    public function userManagment()
    {
        $users = User::with('tasks')->get();
        
        return view('pages.admin.userManagment', ['users' => $users]);
    }
}
