<?php

namespace Tests\Feature\Modules\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * Test access login page
     * @return void
     */
    public function test_access_to_login_page(): void
    {
        $response = $this->get('/auth/login');
        $response->assertStatus(200);
    }

    /**
     * Positive Test
     * Test login with right credential
     * @return void
     */
    public function test_login_with_valid_credentials(): void
    {
        $response = $this->post('/auth/login/submit', [
            'username' => 'admin',
            'password' => Hash::make('P!sang#123'),
            'cf-turnstile-response' => 'XXXX.DUMMY.TOKEN.XXXX'
        ]);

        $response->assertStatus(302);
    }

    /**
     * Negative Test
     * Test with wrong username
     * @return void
     */
    public function test_login_with_wrong_username(): void
    {
        $response = $this->post('/auth/login/submit', [
            'username' => 'admin123',
            'password' => Hash::make('P!sang#123'),
            'cf-turnstile-response' => 'XXXX'
        ]);

        $response->assertRedirect('/auth/login');

        $this->followRedirects($response)
            ->assertStatus(200)
            ->assertSee('Username atau password salah!');
    }

    /**
     * Negative Test
     * Test with wrong password
     * @return void
     */
    public function test_login_with_wrong_password(): void
    {
        $response = $this->post('/auth/login/submit', [
            'username' => 'admin',
            'password' => Hash::make('Sp4g3tigoreng'),
            'cf-turnstile-response' => 'XXXX'
        ]);

        $response->assertRedirect('/auth/login');

        $this->followRedirects($response)
            ->assertStatus(200)
            ->assertSee('Username atau password salah!');
    }
}
