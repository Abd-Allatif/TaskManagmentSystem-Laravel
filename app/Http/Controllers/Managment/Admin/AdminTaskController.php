<?php

namespace App\Http\Controllers\Managment\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminTaskCreateRequest;
use App\Http\Requests\Admin\AdminTaskUpdateRequest;
use App\Models\User;
use App\Repositories\Admin\AdminTaskRepository;
use App\Repositories\AdminRepository;
use App\Repositories\CategoryRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminTaskController extends Controller
{
    protected AdminRepository $adminRepository;
    protected AdminTaskRepository $adminTaskRepository;
    protected CategoryRepository $categoryRepository;

    public function __construct(AdminRepository $adminRepository, AdminTaskRepository $adminTaskRepository, CategoryRepository $categoryRepository)
    {
        $this->adminRepository = $adminRepository;
        $this->adminTaskRepository = $adminTaskRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function taskPage()
    {
        $tasks = $this->adminRepository->getAllTasksWithUsers();

        return view('pages.admin.taskManagment', ['tasks' => $tasks]);
    }

    public function createTaskPage()
    {
        $deadline = Carbon::now()->addDays(10)->toDateString();
        $categories = $this->categoryRepository->getAllCategories();
        $users = User::all();

        return view('pages.admin.Managment.task-create-page', ['categories' => $categories, 'users' => $users, 'deadline' => $deadline]);
    }

    public function createTask(AdminTaskCreateRequest $request)
    {
        $validated = $request->validated();

        $this->adminTaskRepository->createTask($validated);
        // return response()->json($validated);
        return redirect()->route('taskManagment')->with('status', 'Task Created Successfully');
    }

    public function editTaskPage($taskId)
    {
        $task = $this->adminTaskRepository->getTask($taskId);
        $categories = $this->categoryRepository->getAllCategories();
        $users = User::all();

        return view('pages.admin.Managment.task-edit-page', ['task' => $task, 'categories' => $categories, 'users' => $users]);
    }

    public function editTask(AdminTaskUpdateRequest $request, $taskId)
    {
        $validated = $request->validated();

        $this->adminTaskRepository->updateTask($taskId, $validated);

        // return response()->json($validated);
        return redirect()->route('taskManagment')->with('status', 'Task Updated Successfully');
    }

    public function deleteTask(Request $request, $taskId)
    {
        $this->adminTaskRepository->deleteTask($taskId);

        return redirect()->route('taskManagment')->with('status', 'Task Deleted');
    }
}
