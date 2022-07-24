<?php

namespace Tests\Feature\API\v1\Thread;

use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
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

        $response= $this->get(route('threads.show',[$thread->slug]));

        $response->assertStatus(Response::HTTP_OK);
    }
}
