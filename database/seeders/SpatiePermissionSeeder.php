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

        // $adminRole = Role::create(['name' => 'admin']);
        // $userRole = Role::create(['name' => 'user']);

        // // Permissions
        // // Tasks
        // $viewTaskPermission = Permission::create(['name' => 'viewTask']);
        // $createTaskPermission = Permission::create(['name' => 'createTask']);
        // $editTaskPermission = Permission::create(['name' => 'editTask']);
        // $deleteTaskPermission = Permission::create(['name' => 'deleteTask']);

        // $assignToUserTaskPermission = Permission::create(['name' => 'assignToUserTask']);

        // // Status
        // $editStatusAfterComplete = Permission::create(['name' => 'editStatusAfterComplete']);
        // $editStatusAfterExpired = Permission::create(['name' => 'editStatusAfterExpired']);

        // // Category
        // $viewCategoryPermission = Permission::create(['name' => 'viewCategory']);
        // $createCategoryPermission = Permission::create(['name' => 'createCategory']);
        // $editCategoryPermission = Permission::create(['name' => 'editCategory']);
        // $deleteCategoryPermission = Permission::create(['name' => 'deleteCategory']);

        // // Assign Permissions To Admin
        // $adminRole->givePermissionTo('viewTask');
        // $adminRole->givePermissionTo('createTask');
        // $adminRole->givePermissionTo('editTask');
        // $adminRole->givePermissionTo('deleteTask');

        // $adminRole->givePermissionTo('assignToUserTask');

        // $adminRole->givePermissionTo('editStatusAfterComplete');
        // $adminRole->givePermissionTo('editStatusAfterExpired');

        // $adminRole->givePermissionTo('viewCategory');
        // $adminRole->givePermissionTo('createCategory');
        // $adminRole->givePermissionTo('editCategory');
        // $adminRole->givePermissionTo('deleteCategory');

        // // Assign Permissions To User
        // $userRole->givePermissionTo('viewTask');
        // $userRole->givePermissionTo('createTask');
        // $userRole->givePermissionTo('editTask');

        // $userRole->givePermissionTo('viewCategory');

        // $admin = User::factory()->create([
        //     'name' => 'admin',
        //     'email' => 'admin@admin.co',
        //     'password' => '123456789'
        // ]);

        // $admin->assignRole($adminRole);

        // $user = User::factory()->create([
        //     'name' => 'Abd',
        //     'email' => 'abd@gmail.com',
        //     'password' => '123456789'
        // ]);

        // $user->assignRole($userRole);
    }
}
