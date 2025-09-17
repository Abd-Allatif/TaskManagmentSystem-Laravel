<?php

namespace App\Repositories\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class AdminProfileRepository.
 */
class AdminProfileRepository
{
    public function updateAdminProfile($data)
    {
        $admin = Auth::guard('admin')->user();

        if(Hash::check($data['oldPassword'],$admin->password))
        {
            $admin->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['newPassword']
            ]);

            $admin->save();
        }
    }
}
