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

        $permissions = [
            'view Task',
            'Create Task',
            'Edit Task',
            'Delete Task',
            'Edit Status After Complete',
            'Edit Status After Expired',
            'View Category',
            'Create Category',
            'Edit Category',
            'Delete Category',
            'Assign Task To User',
            'View Admins',
            'Create Admins',
            'Edit Admins',
            'Delete Admins',
            'View DashBoard',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission,'guard_name'=>'admin']);
        }
    }
}
