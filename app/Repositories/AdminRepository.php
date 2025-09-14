<?php

namespace App\Repositories;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class AdminRepository.
 */
class AdminRepository
{
    // For Admin
    public function getAllTasksWithUsers()
    {
        // Getting the Parent Task with Categories and thier Sub Tasks Using Scope
        $tasks = Task::parent()->with(
            [
                'users',
                'categories',
                'subTask'
            ]
        )->orderBy('status', 'asc')->orderBy('deadline', 'desc')->get();

        return $tasks;
    }

    public function getDeadlineTasks()
    {
        $week = Carbon::now()->startOfWeek()->startOfDay();
        $endWeek   = Carbon::now()->endOfWeek()->endOfDay();


        $tasks = Task::parent()->with([
            'users',
            'categories'
        ])->whereBetween('deadline', [$week, $endWeek])->orderBy('deadline', 'asc')->get();

        return $tasks;
    }

    public function createUser($data)
    {
        DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            if (isset($data['roles'])) {
                $user->assignRole($data['roles']);
            }

            $user->save();
        });
    }

    public function editUser($userId, $data)
    {
        DB::transaction(function () use ($userId, $data) {
            $user = User::find($userId);

            $user->update([
                'name' => $data['name'] ?? $user->name,
                'email' => $data['email'] ?? $user->email
            ]);

            if (isset($data['roles'])) {
                $user->syncRoles($data['roles']);
            }

            $user->save();
        });
    }
}
