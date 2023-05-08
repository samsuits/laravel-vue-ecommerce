<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function testLogin()
    {
        $email = time() . '@example.com';
        $plainPassword = '123456789';
        $password = bcrypt($plainPassword);
        // Creating Users

        $user = User::create([
            'name' => 'Test',
            'email' => $email,
            'password' => $password,
            'email_verified_at' => now(),
            'is_admin' => true
        ]);

        // Simulated login
        $response = $this->post('api/login', [
            'email' => $email,
            'password' => $plainPassword,
        ]);

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        // Determine whether the login is successful and receive token
        $response->assertStatus(200);

        // Delete users
        User::where('email', $email)->delete();
    }
}
