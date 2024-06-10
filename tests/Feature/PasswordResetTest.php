<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_password_reset_request()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
        ]);

        $response = $this->post('/password/email', [
            'email' => 'test@example.com',
        ]);

        $response->assertSessionHas('status', 'We have emailed your password reset link!');
    }

    public function test_unsuccessful_password_reset_request()
    {
        $response = $this->post('/password/email', [
            'email' => 'nonexistent@example.com',
        ]);

        $response->assertSessionHasErrors(['email']);
    }
}
