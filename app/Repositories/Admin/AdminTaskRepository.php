<?php

namespace App\Repositories\Admin;

use App\enums\CreatedBy;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
//use Your Model

/**
 * Class AdminTaskRepository.
 */
class AdminTaskRepository
{
    public function getTask($taskId)
    {
        $task = Task::parent()->with(['categories', 'users', 'subtask'])->where('id', $taskId)->first();

        return $task;
    }

    public function createTask($data): void
    {
        DB::transaction(function () use ($data) {
            $task = Task::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'create_date' => Carbon::now(),
                'deadline' => $data['deadline'],
                'status' => $data['status'],
                'created_by' => CreatedBy::Admin,
                'end_flag' => false,
            ]);

            if (!empty($data['categories'])) {
                $task->categories()->attach($data['categories']);
            }

            if (!empty($data['users'])) {
                $task->users()->attach($data['users']);
            }
        });
    }

    public function updateTask($taskId, $data): void
    {
        DB::transaction(function () use ($taskId, $data) {
            $task = Task::findOrFail($taskId);

            $task->update([
                'title' => $data['title'],
                'description' => $data['description'],
                'create_date' => Carbon::now(),
                'deadline' => $data['deadline'],
                'status' => $data['status'],
                'created_by' => CreatedBy::Admin,
                'end_flag' => false,
            ]);

            if (!empty($data['categories'])) {
                $task->categories()->sync($data['categories']);
            }

            if (!empty($data['users'])) {
                $task->users()->sync($data['users']);
            }


            if (array_key_exists('subtasks', $data) && count($data['subtasks']) >= 1) {
                foreach ($data['subtasks'] as $id => $description) {
                    $sub = Task::find($id);

                    $sub->update([
                        'title' => Str::words($description, 3, ''),
                        'description' => $description,
                        'create_date' => $task->create_date,
                        'deadline' => $task->deadline,
                        'status' => $task->status,
                        'created_by' => CreatedBy::Admin,
                        'end_flag' => $task->end_flag,
                        'parentTask_id' => $task->id
                    ]);
                }
            }

            if (array_key_exists('new_subtasks',$data) && count($data['new_subtasks']) >= 1) {
                foreach ($data['new_subtasks'] as $subtask) {
                    Task::create([
                        'title' => Str::words($subtask, 3, ''),
                        'description' => $subtask,
                        'create_date' => $task->create_date,
                        'deadline' => $task->deadline,
                        'status' => $task->status,
                        'end_flag' => $task->end_flag,
                        'created_by' => CreatedBy::Admin,
                        'parentTask_id' => $task->id
                    ]);
                }
            }
        });
    }

    public function deleteTask($taskId)
    {
        $task = Task::find($taskId);

        $task->delete();
    }
}
