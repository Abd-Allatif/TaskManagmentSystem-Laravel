<?php

namespace App\Http\Controllers\Managment\Admin;

use App\Http\Controllers\Controller;
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

    public function createTask(Request $request)
    {
        $validated = $request->validate(
            [
                'title' => ['required', 'string'],
                'description' => ['required', 'string'],
                'deadline' => ['required', 'date'],
                'status' => ['required', 'int'],
                'categories' => ['required', 'array', 'min:1'],
                'users' => ['required', 'array', 'min:1']
            ]
        );

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

    public function editTask(Request $request, $taskId)
    {
        $validated = $request->validate(
            [
                'title' => ['required', 'string'],
                'description' => ['required', 'string', 'max:510'],
                'deadline' => ['required', 'date'],
                'status' => ['required', 'int'],
                'categories' => ['required', 'array', 'min:1'],
                'users' => ['required', 'array', 'min:1'],
                'subtasks' => ['nullable', 'array'],
                'subtasks.*' => ['nullable', 'string', 'max:255'],
                'new_subtasks' => ['nullable', 'array'],
                'new_subtasks.*' => ['nullable', 'string', 'max:255']
            ]
        );

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
