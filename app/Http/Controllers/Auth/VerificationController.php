<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\VerificationEmailSendJob;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class VerificationController extends Controller
{
    // When the user Registers the notice will appear
    public function noticePageView()
    {
        return view("auth.verify-email");
    }


    public function sendVerificationEmail()
    {
        $user = Auth::user();

        if ($user->email_verified_at) {
            return redirect()->route('getAllTasks',$user->id);
        }

        $url = URL::temporarySignedRoute(
            'verification.verify',
             Carbon::now()->addMinutes(60),
            ['id' => $user->id]
        );

        VerificationEmailSendJob::dispatch($user, $url);

        return back()->with('status', 'Verification link sent!');
    }

    public function verifyEmail($id)
    {
        $user = User::find($id);

        if (!$user->email_verified_at) {
            $user->email_verified_at = Carbon::now();
            $user->save();
        }
        
        Auth::login($user);

        return redirect()->route('getAllTasks',$id)->with('status', 'Email verified!');
    }
}
