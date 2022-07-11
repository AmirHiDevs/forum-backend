<?php

namespace Tests\Unit\Http\Controllers\API\V01\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_should_be_validate()
    {
        $response = $this->postJson('api/v1/auth/register');

        $response->assertStatus(422);
    }

    public function test_user_can_register()
    {
        $response = $this->registerNewUser();

        $response->assertStatus(201);
    }



    //common functions
    public function registerNewUser(): TestResponse
    {
        return $this->postJson(route('register'), [
            'name' => 'qqq',
            'email' => 'qqq@qqq.com',
            'password' => 'Ab!234%6'
        ]);
    }
}
