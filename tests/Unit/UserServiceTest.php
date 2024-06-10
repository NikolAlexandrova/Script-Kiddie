<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $userService;

    public function setUp(): void
    {
        parent::setUp();
        $this->userService = $this->app->make(UserService::class);
    }

    public function test_registration_with_valid_data()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ];

        $result = $this->userService->register($data);
        $this->assertTrue($result);
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    public function test_registration_with_missing_required_fields()
    {
        $data = [
            'name' => '',
            'email' => 'invalid-email',
            'password' => 'short',
            'password_confirmation' => 'short',
        ];

        $result = $this->userService->register($data);
        $this->assertFalse($result);
        $this->assertDatabaseMissing('users', ['email' => 'invalid-email']);
    }
}
