<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthenticationService
{
    public function login($email, $password)
    {
        Log::info('Attempting login for email: ' . $email);

        $credentials = ['email' => $email, 'password' => $password];

        if (Auth::attempt($credentials)) {
            Log::info('Login successful for email: ' . $email);
            return true;
        } else {
            Log::warning('Login failed for email: ' . $email);
            return false;
        }
    }
}
