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
        $tasks = Task::parent()->with([
            'categories' , 'subTask'
        ]
        )->whereHas('users', function ($query) use ($userId) {
            $query->where('users.id', $userId);
        })->orderBy('status','desc')
        ->get();

        return $tasks;
    }

    public function getTask($taskId){
        $task = Task::parent()->with(['categories','subtask'])->where('id',$taskId)->get();

        return $task;
    }
}
