<?php

namespace App\Http\Controllers\Managment;

use App\enums\Status;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    protected TaskRepository $taskRepository;
    protected $user;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->user = Auth::user();
    }

    public function startTask($taskId)
    {
        $task = $this->taskRepository->getTask($taskId);

        if ($task->status == Status::Pending) {
            $this->taskRepository->startTask($taskId);
            return redirect()->route('getClickedTask', $taskId)->with('status', 'Task Started');
        } else {
            return redirect()->route('getClickedTask', $taskId)->with('status', 'Error The Task Must be Pending to start it');
        }
    }

    public function endTask($taskId)
    {
        $task = $this->taskRepository->getTask($taskId);

        if ($task->status == Status::In_Progress) {
            $this->taskRepository->endTask($taskId);
            return  redirect()->route('getClickedTask', $taskId)->with('status', 'Task Completed');
        } else {
            return redirect()->route('getClickedTask',$taskId)->with('status', 'Please start the task to end it');
        }
    }
}
