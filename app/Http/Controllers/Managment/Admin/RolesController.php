<?php

namespace App\Http\Controllers\Managment\Admin;

use App\Http\Controllers\Controller;
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
        $permissions = Permission::all();

        return view('pages.admin.Managment.role-create-page', ['permissions' => $permissions]);
    }

    public function createRole(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'isAdmin' => ['nullable', 'string'],
            'permissions' => ['array', 'nullable'],
            'permissions.*' => ['string', 'nullable']
        ]);

        $this->rolesRepository->createRole($validated);

        // return response()->json($validated); 
        return redirect()->route('rolesManagment')->with('status', 'Role Created Successfully');
    }

    public function showEditPage($roleId)
    {
        $permissions = Permission::all();

        $role = $this->rolesRepository->getRole($roleId);

        // return response()->json($role);
        return view('pages.admin.Managment.role-edit-page', ['role' => $role,'permissions' => $permissions]);
    }

    public function editRole(Request $request,$roleId)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'isAdmin' => ['nullable', 'string'],
            'permissions' => ['array', 'nullable'],
            'permissions.*' => ['string', 'nullable']
        ]);

        $this->rolesRepository->editRole($validated,$roleId);

        // return response()->json($validated); 
        return redirect()->route('rolesManagment')->with('status', 'Role Updated Successfully');
    }

    public function deleteRole(Request $request,$roleId)
    {
        $this->rolesRepository->deleteRole($roleId,$request->guard);
        return redirect()->route('rolesManagment')->with('status', 'Role Deleted');
    }
}
