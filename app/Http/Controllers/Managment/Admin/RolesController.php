<?php

namespace App\Http\Controllers\Managment\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRoleRequest;
use App\Repositories\Admin\RolesRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{

    protected RolesRepository $rolesRepository;

    public function __construct(RolesRepository $rolesRepository)
    {
        $this->rolesRepository = $rolesRepository;
    }

    public function rolesPage()
    {
        $roles = $this->rolesRepository->getRoles();


        return view('pages.admin.rolesManagment', ['roles' => $roles]);
    }

    public function showCreatePage()
    {
        $webPermissions = $this->rolesRepository->getWebPermissions();
        $adminPermissions = $this->rolesRepository->getAdminPermissions();

        return view('pages.admin.Managment.role-create-page', ['webPermissions' => $webPermissions, 'adminPermissions' => $adminPermissions]);
    }

    public function createRole(AdminRoleRequest $request)
    {
        $validated = $request->validated();

        $this->rolesRepository->createRole($validated);

        // return response()->json($validated); 
        return redirect()->route('rolesManagment')->with('status', 'Role Created Successfully');
    }

    public function showEditPage($roleId)
    {
        $webPermissions = $this->rolesRepository->getWebPermissions();
        $adminPermissions = $this->rolesRepository->getAdminPermissions();

        $role = $this->rolesRepository->getRole($roleId);

        // return response()->json($role);
        return view('pages.admin.Managment.role-edit-page', ['role' => $role, 'webPermissions' => $webPermissions, 'adminPermissions' => $adminPermissions]);
    }

    public function editRole(AdminRoleRequest $request, $roleId)
    {
        $validated = $request->validated();

        $this->rolesRepository->editRole($validated, $roleId);

        // return response()->json($validated); 
        return redirect()->route('rolesManagment')->with('status', 'Role Updated Successfully');
    }

    public function deleteRole(Request $request, $roleId)
    {
        $this->rolesRepository->deleteRole($roleId, $request->guard);
        return redirect()->route('rolesManagment')->with('status', 'Role Deleted');
    }
}
