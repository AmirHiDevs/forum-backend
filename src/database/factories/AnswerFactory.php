<?php

namespace Database\Factories;

use App\Models\Answer;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Answer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'contents' => $this->faker->realText(),
            'thread_id' => $this->faker->numberBetween(1, Thread::query()->get('id')->count()),
            'user_id' => $this->faker->numberBetween(1, User::query()->get('id')->count()),
        ];
    }
}








