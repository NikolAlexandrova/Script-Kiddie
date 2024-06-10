<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\UserService;
use App\Models\User;
use Illuminate\Validation\ValidationException;

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

        $user = $this->userService->register($data);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('test@example.com', $user->email);
    }

    public function test_registration_with_missing_required_fields()
    {
        $this->expectException(ValidationException::class);

        $data = [
            'name' => '',
            'email' => 'invalid-email',
            'password' => 'short',
            'password_confirmation' => 'short',
        ];

        $this->userService->register($data);
    }
}
