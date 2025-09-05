<?php

namespace App\Repositories;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $task = Task::parent()->with(['categories', 'subtask'])->where('id', $taskId)->first();

        return $task;
    }

    public function searchTask($searchQuery, $userId)
    {
        $searchResult = Task::parent()->where('title', 'like', '%' . $searchQuery . '%')->forUser($userId)->orderBy('status', 'desc')->get();

        return $searchResult;
    }

    public function createTask($data, $userId): void
    {
        DB::transaction(function () use ($data, $userId) {
            $task = Task::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'create_date' => Carbon::now(),
                'deadline' => $data['deadline'],
                'status' => $data['status'],
                'end_flag' => false,
            ]);

            if (!empty($data['categories'])) {
                $task->categories()->attach($data['categories']);
            }

            $user = User::find($userId);

            $task->users()->attach($user->id);

            // if (!empty($data['subtitle'])) {
            //     $subTask = Task::create([
            //         'title' => $data['subtitle'],
            //         'description' => $data['subTask'],
            //         'create_date' => Carbon::now(),
            //         'deadline' => $data['deadline'],
            //         'status' => $data['status'],
            //         'end_flag' => false,
            //         'parentTask_id' => $task->id
            //     ]);
            // }
        });
    }

    public function updateTask($taskId, $data, $userId): void
    {
        DB::transaction(function () use ($taskId, $data, $userId) {
            $task = Task::findOrFail($taskId);

            $task->update([
                'title' => $data['title'],
                'description' => $data['description'],
                'create_date' => Carbon::now(),
                'deadline' => $data['deadline'],
                'status' => $data['status'],
                'end_flag' => false,
            ]);

            if (!empty($data['categories'])) {
                $task->categories()->sync($data['categories']);
            }

            $user = User::find($userId);

            $task->users()->sync($user->id);

            // if (isset($data['subtitle'])) {
            //     $subTask = Task::where('parentTask_id',$task->id)->first();
            //     $subTask->update([
            //         'title' => $data['subtitle'],
            //         'description' => $data['subTask'],
            //         'create_date' => Carbon::now(),
            //         'deadline' => $data['deadline'],
            //         'status' => $data['status'],
            //         'end_flag' => false,
            //         'parentTask_id' => $task->id
            //     ]);
            // } else {
            //     $subTask = Task::create([
            //         'title' => $data['subtitle'],
            //         'description' => $data['subTask'],
            //         'create_date' => Carbon::now(),
            //         'deadline' => $data['deadline'],
            //         'status' => $data['status'],
            //         'end_flag' => false,
            //         'parentTask_id' => $task->id
            //     ]);
            // }
        });
    }

    public function createSubTask($taskId, $data, $userId): void
    {

    }

    public function updateSubTask($taskId,$data,$userId): void
    {
        
    }
}
