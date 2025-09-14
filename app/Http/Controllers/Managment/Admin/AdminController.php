<?php

namespace App\Http\Controllers\Managment\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\AdminRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TaskRepository;

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
}
