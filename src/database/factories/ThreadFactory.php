<?php

namespace Database\Factories;

use App\Models\Channel;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ThreadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Thread::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(4);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'contents'=> $this->faker->realText,
            'user_id'=> $this->faker->numberBetween(1, User::query()->get('id')->count()),
            'channel_id'=> $this->faker->numberBetween(1, Channel::query()->get('id')->count()),
            'best_answer_id' => $this->faker->randomNumber(100 || null)
        ];
    }
}
