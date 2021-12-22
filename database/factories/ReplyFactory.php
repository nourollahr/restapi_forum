<?php

namespace Database\Factories;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $thread = Thread::inRandomOrder()->first();
        return [
            'thread_id' => $thread->id,
            'user_id'   => $thread->user_id,
            'body'      => $this->faker->paragraph,
        ];
    }
}
