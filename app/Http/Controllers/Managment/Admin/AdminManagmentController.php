<?php

namespace App\Http\Controllers\Managment\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminManagmentRequest;
use App\Http\Requests\Admin\UpdateAdminManagmentRequest;
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

    public function createAdmin(AdminManagmentRequest $request)
    {
        $validated = $request->validated();

        $this->adminManagmentRepository->createAdmin($validated);

        return redirect()->route('adminManagment')->with('status', 'Admin Created Successfully');
    }

    public function editAdminPage($adminId)
    {
        $admin = $this->adminManagmentRepository->getAdminWithRole($adminId);
        $roles = $this->adminManagmentRepository->getAdminRoles();

        return view('pages.admin.Managment.admin-edit-page', ['admin' => $admin, 'roles' => $roles]);
    }

    public function editAdmin(UpdateAdminManagmentRequest $request, $adminId)
    {
        $validated = $request->validated();

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
