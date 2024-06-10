<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function maxAttempts()
    {
        return 4;
    }

    protected function decayMinutes()
    {
        return 1;
    }

    public function login(Request $request)
    {
        Log::info('Attempting login for email: ' . $request->input('email'));

        $this->validateLogin($request);

        // Check if the user has too many login attempts
        if (RateLimiter::tooManyAttempts($this->throttleKey($request), $this->maxAttempts())) {
            return $this->sendLockoutResponse($request);
        }

        // Attempt to login
        if ($this->attemptLogin($request)) {
            Log::info('Login successful for email: ' . $request->input('email'));
            return $this->sendLoginResponse($request);
        }

        // Increment the login attempts
        RateLimiter::hit($this->throttleKey($request));

        Log::warning('Login failed for email: ' . $request->input('email'));
        return $this->sendFailedLoginResponse($request);
    }

    protected function throttleKey(Request $request)
    {
        return strtolower($request->input($this->username())) . '|' . $request->ip();
    }
}
