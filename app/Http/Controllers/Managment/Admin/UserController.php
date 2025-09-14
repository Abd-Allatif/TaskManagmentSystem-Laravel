<?php

namespace App\Http\Controllers\Managment\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\AdminRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected TaskRepository $taskRepository;
    protected CategoryRepository $categoryRepository;
    protected AdminRepository $adminRepository;

    public function __construct(TaskRepository $taskRepository, CategoryRepository $categoryRepository, AdminRepository $adminRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->categoryRepository = $categoryRepository;
        $this->adminRepository = $adminRepository;
    }

    public function userManagment()
    {
        $users = User::with(['tasks', 'roles', 'permissions'])->get();

        return view('pages.admin.userManagment', ['users' => $users]);
    }

    public function userCreateShow()
    {
        $roles = Role::all();

        return view('pages.admin.Managment.user-create-page', ['roles' => $roles]);
    }

    public function userCreate(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8'],
            'roles' => ['required', 'array'],
            'roles.*' => ['nullable', 'string'],
        ]);

        $this->adminRepository->createUser($validated);

        return redirect()->route('userManagment')->with('status', 'User Created Successfully');
    }

    public function userEditShow($userId)
    {
        $users = User::with(['roles', 'permissions'])->find($userId);
        $roles = Role::all();
        // return response()->json($users);
        return view('pages.admin.Managment.user-edit-page', ['user' => $users, 'roles' => $roles]);
    }

    public function userEdit(Request $request, $userId)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'roles' => ['required', 'array'],
            'roles.*' => ['nullable', 'string'],
        ]);

        $this->adminRepository->editUser($userId, $validated);



        return redirect()->route('userManagment')->with('status', 'User Updated Successfully');
    }

    public function deleteUser($userId)
    {

        $user = User::find($userId);

        $user->delete();

        return redirect()->route('userManagment')->with('status', 'User Deleted');
    }
}
