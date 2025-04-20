<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{
    public function showNotice()
    {

        if (!Auth::user()->email_verified_at) {
            return view('auth.verify-email');
        }
        return redirect('/dashboard');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/dashboard');
    }

    public function resend(Request $request)
    {
        if (!Auth::user()->email_verified_at) {
            $request->user()->sendEmailVerificationNotification();
            return back()->with('message', 'Verification link sent!');
        }

        return back()->with('message', 'Email is already verified. Go to dashboard. replace current route /dashboard');
    }
}
