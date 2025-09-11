<?php

namespace App\Repositories;

use App\enums\CreatedBy;
use App\enums\Status;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

//use Your Model

/**
 * Class TaskRepository.
 */
class TaskRepository
{
    // For Users
    public function getAllTasks($userId)
    {
        $tasks = Task::parent()->with(
            [
                'categories',
                'subTask'
            ]
        )->forUser($userId)->orderBy('status', 'desc')
            ->paginate(10);

        return $tasks->onEachSide(2);
    }

    // For Users
    public function getTask($taskId)
    {
        $task = Task::parent()->with(['categories', 'subtask'])->where('id', $taskId)->first();

        return $task;
    }

    // For Users
    public function searchTask($searchQuery, $userId)
    {
        $searchResult = Task::parent()->where('title', 'like', '%' . $searchQuery . '%')->forUser($userId)->orderBy('status', 'desc')->get();

        return $searchResult;
    }

    // For Users
    public function createTask($data, $userId): void
    {
        DB::transaction(function () use ($data, $userId) {
            $task = Task::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'create_date' => Carbon::now(),
                'deadline' => $data['deadline'],
                'status' => $data['status'],
                'created_by' => CreatedBy::User,
                'end_flag' => false,
            ]);

            if (!empty($data['categories'])) {
                $task->categories()->attach($data['categories']);
            }

            $user = User::find($userId);

            $task->users()->attach($user->id);
        });
    }

    // For Users
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
                'created_by' => CreatedBy::User,
                'end_flag' => false,
            ]);

            if (!empty($data['categories'])) {
                $task->categories()->sync($data['categories']);
            }

            $user = User::find($userId);

            $task->users()->sync($user->id);

            if (array_key_exists('subtasks', $data) && count($data['subtasks']) >= 1) {
                foreach ($data['subtasks'] as $id => $description) {
                    $sub = Task::find($id);

                    $sub->update([
                        'title' => Str::words($description, 3, ''),
                        'description' => $description,
                        'create_date' => $task->create_date,
                        'deadline' => $task->deadline,
                        'status' => $task->status,
                        'created_by' => CreatedBy::User,
                        'end_flag' => $task->end_flag,
                        'parentTask_id' => $taskId
                    ]);
                }
            }
        });
    }

    // For Users
    public function createSubTask($taskId, $data): void
    {
        $task = Task::find($taskId);

        $task = Task::create([
            'title' => Str::words($data, 3, ''),
            'description' => $data,
            'create_date' => $task->create_date,
            'deadline' => $task->deadline,
            'status' => $task->status,
            'end_flag' => $task->end_flag,
            'created_by' => CreatedBy::User,
            'parentTask_id' => $taskId
        ]);
    }

    // For Users
    public function startTask($taskId)
    {
        $task = Task::find($taskId);

        $task->status = Status::In_Progress;

        $task->save();
    }

    // For Users
    public function endTask($taskId)
    {
        $task = Task::find($taskId);

        $task->status = Status::Completed;

        $task->save();
    }
}
