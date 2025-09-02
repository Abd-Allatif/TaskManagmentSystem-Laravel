<?php

namespace App\Http\Controllers\Managment;

use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    // Get all Tasks for a user
    public function getTasks($userId)
    {

        $tasks = $this->taskRepository->getAllTasks($userId);

        // return response()->json($tasks);
        return view('pages.view-tasks', ['tasks' => $tasks, 'userId' => $userId]);
    }

    public function showClickedTask($taskId)
    {
        $task = $this->taskRepository->getTask($taskId);

        // return response()->json($task);
        return view('pages.view-clickedTask', ['task' => $task]);
    }

    public function searchTask(Request $request, $userId)
    {
        $query = $request->validate([
            'searchQuery' => ["required","string"],
        ]);

        $searchResult = $this->taskRepository->searchTask($query['searchQuery'], $userId);

        // return response()->json($searchResult);
        return view('pages.taskSearch',['searchResult' => $searchResult,'userId' => $userId]);
    }
}
