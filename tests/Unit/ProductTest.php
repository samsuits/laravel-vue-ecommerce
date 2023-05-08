<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * Authenticate user.
     *
     * @return string
     */
    protected function authenticate(): string
    {
        if (!Auth::attempt(['email' => 'mike.purifoy@teleworm.us', 'password' => 'Oongies9mee'])) {
            return response(['message' => 'Login credentials are invaild']);
        }

        /** @var User $user */
        $user = Auth::user();

        return $user->createToken('main')->plainTextToken;
    }

    /**
     * test get all products.
     *
     * @return void
     */
    public function test_get_all_product()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', 'api/products');

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    }
}
