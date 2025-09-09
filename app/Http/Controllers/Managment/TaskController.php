<?php

namespace App\Http\Controllers\Managment;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\TaskRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    protected TaskRepository $taskRepository;
    protected CategoryRepository $categoryRepository;
    protected $user;

    public function __construct(TaskRepository $taskRepository, CategoryRepository $categoryRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->categoryRepository = $categoryRepository;
        $this->user = Auth::user();
    }

    // Get all Tasks for a user
    public function getTasks()
    {

        $tasks = $this->taskRepository->getAllTasks($this->user->id);

        $categories = $this->categoryRepository->getAllCategories();

        // return response()->json($categories);
        return view('pages.Tasks.view-tasks', ['tasks' => $tasks, 'categories' => $categories, 'userId' => $this->user->id,'userName' => $this->user->name]);
    }

    public function showClickedTask($taskId)
    {
        $task = $this->taskRepository->getTask($taskId);

        // return response()->json($task);
        return view('pages.Tasks.view-clickedTask', ['task' => $task, 'userId' => $this->user->id]);
    }

    public function searchTask(Request $request)
    {
        $query = $request->validate([
            'searchQuery' => ["required", "string"],
        ]);

        $searchResult = $this->taskRepository->searchTask($query['searchQuery'], $this->user->id);

        // return response()->json($searchResult);
        return view('pages.Tasks.taskSearch', ['searchResult' => $searchResult, 'userId' => $this->user->id]);
    }

    public function ShowcreateTask()
    {
        $deadLine = Carbon::now()->addDays(10);
        $categories = $this->categoryRepository->getAllCategories();

        return view('pages.Tasks.createTask', ['userId' => $this->user->id, 'categories' => $categories, 'deadLine' => $deadLine->toDateString()]);
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
            ]
        );

        $this->taskRepository->createTask($validated, $this->user->id);
        // $category = $this->categoryRepository->getSingleCategory($validated['categories']);

        return redirect()->route('getAllTasks')->with('status', 'Task Created');
    }

    public function showEditPage($taskId)
    {
        $task = $this->taskRepository->getTask($taskId);
        $categories = $this->categoryRepository->getAllCategories();

        return view('pages.Tasks.edit-task', ['task' => $task, 'categories' => $categories, 'userId' => $this->user->id]);
    }

    public function editTask(Request $request, $taskId)
    {
        $validated = $request->validate(
            [
                'title' => ['required', 'string'],
                'description' => ['required', 'string'],
                'deadline' => ['required', 'date'],
                'status' => ['required', 'int'],
                'categories' => ['required', 'array', 'min:1'],
                'subtasks' => ['nullable', 'array'],
                'subtasks.*' => ['nullable', 'string', 'max:255'],
            ]
        );

        $this->taskRepository->updateTask($taskId, $validated, $this->user->id);
        // $category = $this->categoryRepository->getSingleCategory($validated['categories']);

        // return response()->json($validated);
        return redirect()->route('getClickedTask', $taskId)->with('status', 'Task Updated');
    }
}
