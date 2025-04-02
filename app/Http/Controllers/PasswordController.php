<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller
{
    // Show the "forgot password" form
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // Handle the password reset link request
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Check if the email exists and the active_flag is 'Y'
        $user = User::where('email', $request->email)->where('active_flag', 'Y')->first();

        if (!$user) {
            return back()->withErrors(['email' => 'The email address is either invalid or the account is inactive, Please contact your system administrator.']);
        }

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    // Show the "reset password" form
    public function showResetPasswordForm(string $token, Request $request)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    // Handle the password reset
    public function updateResetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed'
        ]);

        $data = [
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        $success = User::where('email', $request->email)->update($data);

        if ($success) {
            session()->flash('success_reset', 'Password has been reset successfully');
            return redirect()->route('login');
        } else {
            return back()->with(['status' => 'Something went wrong. Please contact administrator']);
        }
    }
}
