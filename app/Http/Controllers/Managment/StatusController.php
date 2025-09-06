<?php

namespace App\Http\Controllers\Managment;

use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    protected TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function startTask($taskId, $userId)
    {
        $task = $this->taskRepository->getTask($taskId);

        if ($task->status == 'pending') {
            $this->taskRepository->startTask($taskId);
            return redirect()->route('getClickedTask', [$taskId, $userId])->with('status', 'Task Started');
        } else {
            return redirect()->route('getClickedTask', [$taskId, $userId])->with('status', 'Error The Task Must be Pending to start it');
        }
    }

    public function endTask($taskId, $userId)
    {
        $task = $this->taskRepository->getTask($taskId);

        if ($task->status == 'in_progress') {
            $this->taskRepository->endTask($taskId);
            return  redirect()->route('getClickedTask', [$taskId, $userId])->with('status', 'Task Completed');
        } else {
            return redirect()->route('getClickedTask', [$taskId, $userId])->with('status', 'Please start the task to end it');
        }
    }
}
