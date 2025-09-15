<?php

namespace App\Repositories\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class UserRepository.
 */
class UserRepository
{
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
