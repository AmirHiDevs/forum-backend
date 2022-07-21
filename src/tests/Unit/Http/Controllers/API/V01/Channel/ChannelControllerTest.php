<?php

namespace Tests\Unit\Http\Controllers\API\V01\Channel;


use App\Models\Channel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class ChannelControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_all_channels_should_be_accessible()
    {
        $response = $this->get(route('channel.all'));

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_channel_creating_should_be_validated()
    {
        $response = $this->postJson(route('channel.create'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_channel_can_be_created()
    {
        $response = $this->postJson(route('channel.create'),[
           'name' => 'laravel'
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_updated_channel_should_be_validated()
    {
        $response = $this->Json('PUT',route('channel.update'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_channel_can_be_updated()
    {
        $channel = Channel::factory()->create([
            'name'=>'Laravel'
        ]);
        $response = $this->Json('PUT',route('channel.update',[
            'id'=> $channel->id,
            'name'=> 'Vue.js'
        ]));

        $updatedChannel = Channel::find($channel->id);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals('Vue.js',$updatedChannel->name);
    }
}
