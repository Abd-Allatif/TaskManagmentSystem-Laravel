<?php

namespace App\Repositories\Admin;

use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

//use Your Model

/**
 * Class RolesRepository.
 */
class RolesRepository
{
    public function getRoles()
    {
        $roles = Role::withCount('users')->with(['permissions'])->orderBy('guard_name','desc')->get();

        return $roles;
    }

    public function getRole($roleId)
    {
        $role = Role::with(['permissions'])->find($roleId);

        return $role;
    }

    public function getWebPermissions()
    {
        $permissions = Permission::where('guard_name','web')->get();

        return $permissions;
    }

    public function getAdminPermissions()
    {
         $permissions = Permission::where('guard_name','admin')->get();

        return $permissions;
    }

    public function createRole($data)
    {
        DB::transaction(function () use ($data) {
            if (isset($data['isAdmin']) && $data['isAdmin']) {
                $role = Role::create([
                    'name' => $data['name'],
                    'guard_name' => 'admin'
                ]);
                isset($data['permissions']) ? $role->syncPermissions($data['permissions']) : null;
            } else {
                $role = Role::create([
                    'name' => $data['name'],
                    'guard_name' => 'web'
                ]);
                isset($data['permissions']) ? $role->syncPermissions($data['permissions']) : null;
            }
        });
    }

    public function editRole($data, $roleId)
    {
        DB::transaction(function () use ($data, $roleId) {
            if (isset($data['isAdmin']) && $data['isAdmin']) {
                $role = Role::where('id', $roleId)->first();
                $role->update([
                    'name' => $data['name'],
                    'guard_name' => 'admin'
                ]);

                isset($data['permissions']) ? $role->syncPermissions($data['permissions']) :  $role->syncPermissions([]);
            } else {
                $role = Role::where('id', $roleId)->first();
                $role->update([
                    'name' => $data['name'],
                    'guard_name' => 'web'
                ]);

                isset($data['permissions']) ? $role->syncPermissions($data['permissions']) : $role->syncPermissions([]);
            }
        });
    }

    public function deleteRole($roleId, $guard_name)
    {
        $role = Role::where('id', $roleId)->where('guard_name', $guard_name)->first();
        $role->delete();
    }
}
