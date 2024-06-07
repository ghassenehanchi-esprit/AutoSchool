<?php

namespace App\Http\Controllers\Auth;

use App\Constants\Status;
use App\Models\UserLogin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;


    protected $redirectTo = '/user/home';
    protected $username;

    public function __construct()
    {
        $this->username = $this->findUsername();
    }

    public function showLoginForm()
    {
        $pageTitle = "Login";
        return view('auth.login', compact('pageTitle'));
    }

    public function showpassform()
    {
        $pageTitle = "Forgot Password";
        return view('auth.passwords.email', compact('pageTitle'));
    }

    /**
     * Handle a send password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == \Illuminate\Auth\Passwords\PasswordBroker::RESET_LINK_SENT
            ? back()->with('status', trans($response))
            : back()->withErrors(
                ['email' => trans($response)]
            );
    }

    public function login(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $this->credentials($request);

        // Attempt to log in the user or admin
        if (auth('user')->attempt($credentials)) {
            // If successful, redirect to their intended location
            return redirect('/');
        } elseif (auth('admin')->attempt($credentials)) {
            // If admin login is successful, redirect to admin dashboard
            return redirect()->route('admin.dashboard');
        }

        // If unsuccessful, redirect back to the login with form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    public function findUsername()
    {
        $login = request()->input('email');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$fieldType => $login]);
        return $fieldType;
    }

    public function username()
    {
        return $this->username;
    }
    public function logout(Request $request)
    {
        if (auth('admin')->check()) {
            auth('admin')->logout();
            return redirect('/admin');
        } elseif (auth('user')->check()) {
            auth('user')->logout();
            return redirect('/');
        }

        return redirect('/'); // Default redirect if no guards are checked
    }


// Helper method to determine the guard
    protected function getGuard() {
        if (Auth::guard('admin')->check()) {
            return 'admin';
        }

        return 'web';
    }


}
