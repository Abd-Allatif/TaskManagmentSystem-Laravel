<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Jobs\VerificationEmailSendJob;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class VerificationController extends Controller
{
    // When the user Registers the notice will appear
    public function noticePageView()
    {
        return view("auth.admin.admin-verify-email");
    }


    public function sendVerificationEmail()
    {
        $admin = Auth::guard('admin')->user();

        if ($admin->email_verified_at) {
            return redirect()->route('dashboard', $admin->id);
        }

        $url = URL::temporarySignedRoute(
            'amdin-verification.verify',
            Carbon::now()->addMinutes(60),
            ['id' => $admin->id]
        );

        VerificationEmailSendJob::dispatch($admin, $url);

        return back()->with('status', 'Verification link sent!');
    }

    public function verifyEmail($id)
    {
        $admin = Admin::find($id);

        if (!$admin->email_verified_at) {
            $admin->email_verified_at = Carbon::now();
            $admin->save();
        }

        Auth::guard('admin')->login($admin);

        return redirect()->route('dashboard')->with('status', 'Email verified!');
    }
}
