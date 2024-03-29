<?php

namespace Tests\Feature\API\v1\Channel;


use App\Models\Channel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use function route;

class ChannelTest extends TestCase
{
    use RefreshDatabase;
    protected bool $seed = true;

    public function test_all_channels_should_be_accessible()
    {
        $response = $this->get(route('channels.index'));

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_channel_creating_should_be_validated()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $user->givePermissionTo('Manage_Channels');
        $response = $this->postJson(route('channels.store'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_channel_can_be_created()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $user->givePermissionTo('Manage_Channels');
        $response = $this->postJson(route('channels.store',[
           'name' => 'laravel'
        ]));

        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_updating_channel_should_be_validated()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $user->givePermissionTo('Manage_Channels');
        $channel = Channel::factory()->create();

        $response = $this->putJson(route('channels.update',$channel->id));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_channel_can_be_updated()
    {
        $channel = Channel::factory()->create([
            'name'=>'Laravel'
        ]);
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $user->givePermissionTo('Manage_Channels');
        $response = $this->putJson(route('channels.update', $channel->id),[
            'id'=> $channel->id,
            'name'=> 'Vue.js'
        ]);

        $updatedChannel = Channel::find($channel->id);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals('Vue.js',$updatedChannel->name);
    }

    public function test_deleting_channel_should_be_validated()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $user->givePermissionTo('Manage_Channels');
        $channel = Channel::factory()->create();


        $response = $this->deleteJson(route('channels.destroy',$channel->id));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_channel_can_be_delete()
    {
        $channel = Channel::factory()->create();

        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $user->givePermissionTo('Manage_Channels');
        $response = $this->deleteJson(route('channels.destroy', $channel->id),[
            'id'=> $channel->id
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }
}
