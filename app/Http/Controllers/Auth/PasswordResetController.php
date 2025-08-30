<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\ResetLinkEmailJOb;
use App\Mail\PasswordResetMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function create()
    {
        return view('auth.forgot-password');
    }

    // Creating the token and sending Email
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $token = Str::random(60);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        ResetLinkEmailJOb::dispatch($validated['email'], $token);

        return back()->with('status', 'Password Resent Link is Sent to Your Email');
    }


    public function showResetPage(Request $request, $token)
    {
        $tokenExpiryCheck = DB::table('password_reset_tokens')->where('token', $token)->first();

        // parese is used to convert the string date from the field into Carbon object
        if (!$tokenExpiryCheck || Carbon::parse($tokenExpiryCheck->created_at)->addMinutes(60)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return redirect()->route('password.request')->withErrors(['token' => 'This Password Reset Link invalid or Expired Try Again']);
        }

        return view("auth.reset-password")->with(["token" => $token, 'email' => $request->email]);
    }

    public function resetPassword(Request $request)
    {

        $validated = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
            'token' => ['required', 'string'],
        ]);

        $tokenExpiryCheck = DB::table('password_reset_tokens')->where('token', $request->token)->first();

        if (!$tokenExpiryCheck || Carbon::parse($tokenExpiryCheck->created_at)->addMinutes(60)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return redirect()->route('password.request')->withErrors(['token' => 'This Password Reset Link invalid or Expired Try Again']);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($validated['password']);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Your password has been reset!');
    }
}
