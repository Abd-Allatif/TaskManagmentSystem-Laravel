<?php

namespace App\Repositories\Admin;

use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Spatie\Permission\Models\Role;

//use Your Model

/**
 * Class RolesRepository.
 */
class RolesRepository
{
    public function getRoles()
    {
        $roles = Role::withCount('users')->with(['permissions'])->get();

        return $roles;
    }

    public function getRole($roleId)
    {
        $role = Role::with(['permissions'])->find($roleId);

        return $role;
    }

    public function createRole($data)
    {
        DB::transaction(function () use ($data) {
            if (isset($data['isAdmin'])) {
                $role = Role::create([
                    'name' => $data['name'],
                    'guard_name' => $data['isAdmin']
                ]);
                $role->givePermissionTo($data['permissions']);
            } else {
                $role = Role::create([
                    'name' => $data['name'],
                    'guard_name' => 'web'
                ]);
                $role->givePermissionTo($data['permissions']);
            }
        });
    }

    public function editRole($data, $roleId)
    {
        DB::transaction(function () use ($data, $roleId) {
            if (isset($data['isAdmin'])) {
                $role = Role::where('id', $roleId)->where('guard_name', $data['isAdmin'])->first();
                $role->update([
                    'name' => $data['name'],
                    'guard_name' => $data['isAdmin']
                ]);
                $role->givePermissionTo($data['permissions']);
            } else {
                $role = Role::where('id', $roleId)->where('guard_name', 'web')->first();
                $role->update([
                    'name' => $data['name'],
                    'guard_name' => 'web'
                ]);
                $role->givePermissionTo($data['permissions']);
            }
        });
    }

    public function deleteRole($roleId,$guard_name)
    {
        $role = Role::where('id', $roleId)->where('guard_name', $guard_name)->first();
        $role->delete();
    }
}
