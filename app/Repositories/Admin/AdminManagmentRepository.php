<?php

namespace App\Repositories\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Spatie\Permission\Models\Role;

//use Your Model

/**
 * Class AdminManagmentRepository.
 */
class AdminManagmentRepository
{
    public function getAllAdmins()
    {
        $admins = Admin::with('roles', 'permissions')->get();

        return $admins;
    }

    public function getAdminWithRole($adminId)
    {
        $user = Admin::with(['roles', 'permissions'])->find($adminId);

        return $user;
    }

    // Admin Guard Roles
    public function getAdminRoles()
    {
        $role = Role::where('guard_name','admin')->get();

        return $role;
    }

    public function createAdmin($data)
    {
        DB::transaction(function () use ($data) {
            $admin = Admin::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            if (isset($data['roles'])) {
                $admin->assignRole($data['roles']);
            }

            $admin->save();
        });
    }

    public function editAdmin($adminId, $data)
    {
        DB::transaction(function () use ($adminId, $data) {
            $admin = Admin::find($adminId);

            $admin->update([
                'name' => $data['name'] ?? $admin->name,
                'email' => $data['email'] ?? $admin->email
            ]);

            if (isset($data['roles'])) {
                $admin->syncRoles($data['roles']);
            }

            $admin->save();
        });
    }
}
