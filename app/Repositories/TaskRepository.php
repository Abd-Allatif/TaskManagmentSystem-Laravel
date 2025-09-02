<?php

namespace App\Repositories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
//use Your Model

/**
 * Class TaskRepository.
 */
class TaskRepository
{
    public function getAllTasks($userId)
    {
        // Getting the Parent Task with Categories and thier Sub Tasks Using Scope
        $tasks = Task::parent()->with(
            [
                'categories',
                'subTask'
            ]
        )->forUser($userId)->orderBy('status', 'desc')
            ->get();

        return $tasks;
    }

    public function getTask($taskId)
    {
        $task = Task::parent()->with(['categories', 'subtask'])->where('id', $taskId)->get();

        return $task;
    }

    public function searchTask($searchQuery, $userId)
    {
        $searchResult = Task::parent()->where('title', 'like', '%' . $searchQuery . '%')->forUser($userId)->orderBy('status', 'desc')->get();

        return $searchResult;
    }

    public function createTask(array $data, $userId) {}
}
