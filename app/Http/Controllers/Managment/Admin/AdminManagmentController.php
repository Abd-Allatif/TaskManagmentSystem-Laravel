<?php

namespace App\Http\Controllers\Managment\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Repositories\Admin\AdminManagmentRepository;
use Illuminate\Http\Request;

class AdminManagmentController extends Controller
{
    protected AdminManagmentRepository $adminManagmentRepository;

    public function __construct(AdminManagmentRepository $adminManagmentRepository)
    {
        $this->adminManagmentRepository = $adminManagmentRepository;
    }

    public function adminPage()
    {
        $admins = $this->adminManagmentRepository->getAllAdmins();

        return view('pages.admin.adminManagment', ['admins' => $admins]);
    }

    public function createAdminPage()
    {
        $roles = $this->adminManagmentRepository->getAdminRoles();

        return view('pages.admin.Managment.admin-create-page', ['roles' => $roles]);
    }

    public function createAdmin(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['nullable', 'string'],
        ]);

        $this->adminManagmentRepository->createAdmin($validated);

        return redirect()->route('adminManagment')->with('status', 'Admin Created Successfully');
    }

    public function editAdminPage($adminId)
    {
        $admin = $this->adminManagmentRepository->getAdminWithRole($adminId);
        $roles = $this->adminManagmentRepository->getAdminRoles();

        return view('pages.admin.Managment.admin-edit-page', ['admin' => $admin, 'roles' => $roles]);
    }

    public function editAdmin(Request $request, $adminId)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['nullable', 'string'],
        ]);

        $this->adminManagmentRepository->editAdmin($adminId, $validated);

        return redirect()->route('adminManagment')->with('status', 'Admin Updated Successfully');
    }

    public function deleteAdmin($adminId)
    {
        $admin = Admin::find($adminId);

        $admin->delete();

        return redirect()->route('adminManagment')->with('status', 'Admin Deleted');
    }
}
