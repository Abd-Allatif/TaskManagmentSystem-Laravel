<?php

namespace App\Http\Controllers\Managment;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\TaskRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected TaskRepository $taskRepository;
    protected CategoryRepository $categoryRepository;

    public function __construct(TaskRepository $taskRepository, CategoryRepository $categoryRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->categoryRepository = $categoryRepository;
    }

    // Get all Tasks for a user
    public function getTasks($userId)
    {

        $tasks = $this->taskRepository->getAllTasks($userId);

        $categories = $this->categoryRepository->getAllCategories();

        // return response()->json($categories);
        return view('pages.Tasks.view-tasks', ['tasks' => $tasks, 'categories' => $categories, 'userId' => $userId]);
    }

    public function showClickedTask($taskId, $userId)
    {
        $task = $this->taskRepository->getTask($taskId);

        // return response()->json($task);
        return view('pages.Tasks.view-clickedTask', ['task' => $task, 'userId' => $userId]);
    }

    public function searchTask(Request $request, $userId)
    {
        $query = $request->validate([
            'searchQuery' => ["required", "string"],
        ]);

        $searchResult = $this->taskRepository->searchTask($query['searchQuery'], $userId);

        // return response()->json($searchResult);
        return view('pages.Tasks.taskSearch', ['searchResult' => $searchResult, 'userId' => $userId]);
    }

    public function ShowcreateTask($userId)
    {
        $deadLine = Carbon::now()->addDays(10);
        $categories = $this->categoryRepository->getAllCategories();

        return view('pages.Tasks.createTask', ['userId' => $userId, 'categories' => $categories, 'deadLine' => $deadLine->toDateString()]);
    }

    public function createTask(Request $request, $userId)
    {
        $validated = $request->validate(
            [
                'title' => ['required', 'string'],
                'description' => ['required', 'string'],
                'deadline' => ['required', 'date'],
                'status' => ['required', 'string'],
                'categories' => ['required', 'array', 'min:1'],
            ]
        );

        $this->taskRepository->createTask($validated, $userId);
        // $category = $this->categoryRepository->getSingleCategory($validated['categories']);

        return redirect()->route('createTask', $userId)->with('status', 'Task Created');
    }

    public function showEditPage($taskId, $userId)
    {
        $task = $this->taskRepository->getTask($taskId);
        $categories = $this->categoryRepository->getAllCategories();

        return view('pages.Tasks.edit-task', ['task' => $task, 'categories' => $categories, 'userId' => $userId]);
    }

    public function editTask(Request $request, $taskId, $userId)
    {
        $validated = $request->validate(
            [
                'title' => ['required', 'string'],
                'description' => ['required', 'string'],
                'deadline' => ['required', 'date'],
                'status' => ['required', 'string'],
                'categories' => ['required', 'array', 'min:1'],
                'subtasks' => ['required', 'array'],
                'subtasks.*' => ['required', 'string', 'max:255'],
            ]
        );

        $this->taskRepository->updateTask($taskId, $validated, $userId);
        // $category = $this->categoryRepository->getSingleCategory($validated['categories']);

        // return response()->json($validated);
        return redirect()->route('showEditPage', [$taskId, $userId])->with('status', 'Task Updated');
    }
}
