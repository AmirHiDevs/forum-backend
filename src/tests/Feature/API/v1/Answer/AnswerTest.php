<?php

namespace Tests\Feature\API\v1\Answer;


use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AnswerTest extends TestCase
{
    use RefreshDatabase;
    protected bool $seed = true;

    public function test_all_answers_should_be_accessible()
    {
        $response = $this->get(route('answers.index'));

        $response->assertSuccessful();
    }

    public function test_creating_answer_should_be_validated()
    {
        $response = $this->postJson(route('answers.store'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_answer_can_be_created()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);


        $response = $this->postJson(route('answers.store', [
            'contents' => 'Bar',
            'thread_id' => Thread::factory()->create()->id,
        ]));

        $response->assertStatus(Response::HTTP_CREATED);
    }


}
