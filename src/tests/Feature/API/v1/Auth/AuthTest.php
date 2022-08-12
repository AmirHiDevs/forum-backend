<?php

namespace Tests\Feature\API\v1\Auth;


use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Testing\TestResponse;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use function route;


class AuthTest extends TestCase
{
    use RefreshDatabase;
    protected bool $seed = true;

    public function test_user_should_have_valid_login()
    {
        $response = $this->postJson(route('login'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_user_can_register()
    {
        $response = $this->registerNewUser();

        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_user_should_have_valid_register()
    {
        $response = $this->postJson(route('register'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_user_can_login_by_email()
    {
        $user = User::factory()->create();

        $response = $this->postJson(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_logged_in_user_can_logout()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->postJson(route('logout'));

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_logged_in_user_can_see_his_info()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $response = $this->get(route('user.info'));

        $response->assertStatus(Response::HTTP_OK);
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
