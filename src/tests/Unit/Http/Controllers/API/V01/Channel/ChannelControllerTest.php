<?php

namespace Tests\Unit\Http\Controllers\API\V01\Channel;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class ChannelControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_all_channels_should_be_accessible()
    {
        $response = $this->get(route('channel.all'));

        $response->assertStatus(200);
    }

    public function test_channel_creating_should_be_validated()
    {
        $response = $this->postJson(route('channel.create'));

        $response->assertStatus(422);
    }

    public function test_channel_can_be_created()
    {
        $response = $this->postJson(route('channel.create'),[
           'name' => 'laravel'
        ]);

        $response->assertStatus(201);
    }


}
