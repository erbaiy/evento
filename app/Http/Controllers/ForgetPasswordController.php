<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    public function forgetPassword()
    {
        return view('auth.forgetpassword');
    }

    public function sendToEmail(Request $request)
    {
        $email = $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::where('email', $email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->withInput();
        }
        $token = Str::random($length = 33);
        User::where('email', $request->email)
            ->update(['remember_token' => $token]);
        $link = route(('reset-password'), ['token' => $token]);

        $success = Mail::raw('To reset your password, click on the following link: ' . $link, function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Password Reset Link');
        });

        // dd($link);

        if ($success) {

            return back()->with('success', 'We have e-mailed your password reset link!');
        } else {
            return back()->withErrors(['email' => 'There was an error sending your email.']);
        }
    }


    public function getThenewPassword($token)
    {
        return view('auth.newpassword')->with('token', $token);
    }

    public function addNewPassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = User::where('remember_token', $request->token)->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->remember_token = null;
            $user->save();

            return redirect()->route('getSignInView')->with('status', 'Your password has been changed successfully! Please login now');
        } else {
            dd(0);
        }
    }
}
