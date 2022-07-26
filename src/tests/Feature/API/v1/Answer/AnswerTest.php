<?php

namespace Tests\Feature\API\v1\Answer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
}
