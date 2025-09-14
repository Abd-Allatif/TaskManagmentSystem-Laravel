<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class SpatiePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $ItRole = Role::create(['name' => 'It']);
        $DesignerRole = Role::create(['name' => 'Graphic-Designers']);

        $permissions = [
            'viewTask',
            'editTask',
            'deleteTask',
            'editStatusAfterComplete',
            'editStatusAfterExpired',
            'viewCategory',
            'createCategory',
            'editCategory',
            'deleteCategory',
            'assignToUserTask'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $ItRole->givePermissionTo(['viewTask','viewCategory']);
        $DesignerRole->givePermissionTo(['viewTask','viewCategory']);

        $users = User::all();

        foreach ($users as $user) {
            if (fake()->boolean(50)) {
                $user->assignRole($ItRole);
            } else {
                $user->assignRole($DesignerRole);
            }
        }
    }
}
