<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    /**
     * Show the email verification notice.
     */
    public function notice()
    {
        return view('auth.verify-email');
    }

    /**
     * Verify the user's email.
     */
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('welcome', ['locale' => app()->getLocale()])
        ->with('success', 'Your email has been verified!');
    }

    /**
     * Resend the email verification link.
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return back()->with('status', 'Your email is already verified.');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'Verification link has been resent. Please check your email!');
    }
}
