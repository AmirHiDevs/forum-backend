<?php

namespace Tests\Feature\API\v1\Thread;

use App\Models\Channel;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_threads_should_be_accessible()
    {
        $response = $this->get(route('threads.index'));

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_thread_should_get_by_slug()
    {
        $thread = Thread::factory()->create();

        $response = $this->get(route('threads.show', [$thread->slug]));

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_creating_thread_should_be_validated()
    {
        $response = $this->postJson(route('threads.store'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_thread_can_be_created()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);


        $response = $this->postJson(route('threads.store', [
            'title' => 'Foo',
            'contents' => 'Bar',
            'channel_id' => Channel::factory()->create()->id,
        ]));

        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_updating_thread_should_be_validated()
    {
        $thread = Thread::factory()->create();
        $response = $this->putJson(route('threads.update', $thread->id));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_thread_should_be_updated()
    {

        $user = User::factory()->create();
        Sanctum::actingAs($user);


        $thread = Thread::factory()->create([
            'title' => 'John',
            'contents' => 'Doe',
            'channel_id' => 1,
            'best_answer_id' => 2,
            'user_id' => $user->id,
        ]);

        $this->putJson(route('threads.update', $thread->id), [
            'id' => $thread->id,
            'user_id' => $user->id,
            'title' => 'Foo',
            'contents' => 'Bar',
            'channel_id' => 2,
            'best_answer_id' => 4
        ])->assertSuccessful();

        $thread->refresh();
        $this->assertSame('Foo', $thread->title);
        $this->assertSame(4, $thread->best_answer_id);
    }

    public function test_thread_can_be_deleted()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $thread = Thread::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->deleteJson(route('threads.destroy', $thread->id), [
            'id' => $thread->id,
            'user_id' => $user->id,
        ])->assertSuccessful();
    }
}
