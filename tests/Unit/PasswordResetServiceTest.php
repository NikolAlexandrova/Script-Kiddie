<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\PasswordResetService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class PasswordResetServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $passwordResetService;

    public function setUp(): void
    {
        parent::setUp();
        $this->passwordResetService = $this->app->make(PasswordResetService::class);
    }

    public function test_password_reset_request_with_registered_email()
    {
        $user = User::factory()->create(['email' => 'test@example.com']);
        $result = $this->passwordResetService->sendResetLink('test@example.com');
        $this->assertTrue($result);
    }

    public function test_password_reset_request_with_unregistered_email()
    {
        $result = $this->passwordResetService->sendResetLink('nonexistent@example.com');
        $this->assertFalse($result);
    }
}
