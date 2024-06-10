<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticationServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $authService;

    public function setUp(): void
    {
        parent::setUp();
        $this->authService = $this->app->make(\App\Services\AuthenticationService::class);
    }

    public function test_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
        ]);

        $result = $this->authService->login('user@example.com', 'password123');
        $this->assertTrue($result);
    }

    public function test_login_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
        ]);

        $result = $this->authService->login('user@example.com', 'wrongpassword');
        $this->assertFalse($result);
    }

    public function test_login_with_nonexistent_email()
    {
        $result = $this->authService->login('nonexistent@example.com', 'password123');
        $this->assertFalse($result);
    }
}
