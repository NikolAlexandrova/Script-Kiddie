<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->input('email'))->first();

        if ($user && Hash::check($request->input('password'), $user->password)) {
            if (Auth::attempt($credentials)) {
                Log::info('Login successful for email: ' . $request->input('email'));
                return redirect()->intended($this->redirectTo);
            }
        }

        Log::warning('Login failed for email: ' . $request->input('email'));
        return redirect()->back()->withErrors(['email' => 'These credentials do not match our records.']);
    }
}
