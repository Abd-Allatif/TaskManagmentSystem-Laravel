<?php

namespace App\Http\Controllers\Managment\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Admin\UserRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function userManagment()
    {
        $users = $this->userRepository->getAllUsersWithRoles();

        return view('pages.admin.userManagment', ['users' => $users]);
    }

    public function userCreateShow()
    {
       $roles = $this->userRepository->getWebRoles();

        return view('pages.admin.Managment.user-create-page', ['roles' => $roles]);
    }

    public function userCreate(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['nullable', 'string'],
        ]);

        $this->userRepository->createUser($validated);

        return redirect()->route('userManagment')->with('status', 'User Created Successfully');
    }

    public function userEditShow($userId)
    {
        $users = $this->userRepository->getUserWithRole($userId);
        $roles = $this->userRepository->getWebRoles();
        // return response()->json($users);
        return view('pages.admin.Managment.user-edit-page', ['user' => $users, 'roles' => $roles]);
    }

    public function userEdit(Request $request, $userId)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['nullable', 'string'],
        ]);

        $this->userRepository->editUser($userId, $validated);



        return redirect()->route('userManagment')->with('status', 'User Updated Successfully');
    }

    public function deleteUser($userId)
    {

        $user = User::find($userId);

        $user->delete();

        return redirect()->route('userManagment')->with('status', 'User Deleted');
    }
}
