<?php

namespace App\Http\Controllers\Managment;

use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;

class SubTaskController extends Controller
{
    protected TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function createSubTask(Request $request, $taskId)
    {
        $validated = $request->validate([
            'subtasks' => ['required','array'],
            'subtasks.*' => ['required','string','max:255'],
        ]);

        foreach ($validated['subtasks'] as $subtask) {
            $this->taskRepository->createSubTask($taskId, $subtask);
        }

        return redirect()->back()->with('success', 'Subtasks added successfully.');
    }
}
