<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\User;

class ThrottlingTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_attempts_within_limit()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password123'),
        ]);

        for ($i = 0; $i < 5; $i++) {
            $response = $this->post('/login', [
                'email' => 'user@example.com',
                'password' => 'wrongpassword',
            ]);

            $response->assertStatus(302);
        }
    }

    public function test_login_attempts_exceeding_limit()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password123'),
        ]);

        for ($i = 0; $i < 6; $i++) {
            $response = $this->post('/login', [
                'email' => 'user@example.com',
                'password' => 'wrongpassword',
            ]);
        }

        $response->assertStatus(429); // Too many requests status code
    }
}
