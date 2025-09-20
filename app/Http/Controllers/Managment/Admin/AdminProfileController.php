<?php

namespace App\Http\Controllers\Managment\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminProfileUpdateRequest;
use App\Repositories\Admin\AdminProfileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    protected AdminProfileRepository $adminProfileRepository;

    public function __construct(AdminProfileRepository $adminProfileRepository)
    {
        $this->adminProfileRepository = $adminProfileRepository;
    }

    public function profilePage()
    {
        $admin = Auth::guard('admin')->user();

        return view('pages.admin.Managment.profile', ['admin' => $admin]);
    }

    public function editProfile(AdminProfileUpdateRequest $request)
    {
        $validated = $request->validated();

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($validated['oldPassword'], $admin->password)) {
            return redirect()->route('adminProfile')->with('status', 'Your Old Password Doesnt Match our Records');
        }

        $this->adminProfileRepository->updateAdminProfile($validated);

        return redirect()->route('adminProfile')->with('status', 'Profile Updated');
    }
}
