<?php

namespace Tests\Feature\API\v1\Answer;


use App\Models\Answer;
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

    public function test_user_score_should_be_increased_after_submit_new_answer()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->postJson(route('answers.store', [
            'contents' => 'Bar',
            'thread_id' => Thread::factory()->create()->id,
        ]));

        $response->assertStatus(Response::HTTP_CREATED);
        $user->refresh();
        $this->assertEquals(10,$user->score);
    }

    public function test_updating_answer_should_be_validated()
    {
        $answer = Answer::factory()->create();
        $response = $this->putJson(route('answers.update', $answer->id));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_answer_should_be_updated()
    {

        $user = User::factory()->create();
        Sanctum::actingAs($user);


        $answer = Answer::factory()->create([
            'contents' => 'Foo',
            'thread_id' => 1,
            'user_id' => $user->id,
        ]);

        $this->putJson(route('answers.update', $answer->id), [
            'id' => $answer->id,
            'thread_id' => 2,
            'contents' => 'Bar',
        ])->assertSuccessful();

        $answer->refresh();
        $this->assertSame('Bar', $answer->contents);
    }

    public function test_answer_can_be_deleted()
    {

        $user = User::factory()->create();
        Sanctum::actingAs($user);

        Thread::factory()->create();

        $answer = Answer::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->deleteJson(route('answers.destroy', $answer->id), [
            'id' => $answer->id,
            'user_id' => $user->id,
        ])->assertSuccessful();


        $response = Thread::with('answers')
            ->find($answer->thread_id)
            ->Where('contents',$answer->contents)
            ->exists();

        $this->assertFalse($response);
    }


}
