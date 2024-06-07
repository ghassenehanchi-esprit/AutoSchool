<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Contracts\Auth\PasswordBroker as PasswordBrokerAlias;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Auth\Notifications\VerifyEmail;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    /**
     * Handle a send password reset link request.
     *
     * @param Request $request
     * @return RedirectResponse
     */

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // Check if the user with the provided email exists
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => trans('passwords.user')]);
        }

        // Check if the user has verified their email address
        if (!$user->hasVerifiedEmail()) {
            return back()->withErrors(['email' => trans('Verify your email first')]);
        }

        // Send the password reset link
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == PasswordBrokerAlias::RESET_LINK_SENT
            ? back()->with('status', trans($response))
            : back()->withErrors(['email' => trans($response)]);
    }

    /**
     * Validate the email address for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }
}
