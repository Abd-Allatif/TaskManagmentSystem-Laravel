<?php

namespace App\Repositories\Admin;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Spatie\Permission\Models\Role;

//use Your Model

/**
 * Class UserRepository.
 */
class UserRepository
{
    public function getAllUsersWithRoles()
    {
        $users = User::with(['tasks', 'roles', 'permissions'])->get();

        return $users;
    }

    public function getUserWithRole($userId)
    {
        $user = User::with(['roles', 'permissions'])->find($userId);

        return $user;
    }

    // Web Guard Roles
    public function getWebRoles()
    {
        $role = Role::where('guard_name','web')->get();

        return $role;
    }

    public function createUser($data)
    {
        DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'email_verified_at' => Carbon::now(),
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
