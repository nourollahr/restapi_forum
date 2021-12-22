<?php

namespace Database\Factories;

use App\Models\Channel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThreadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'    => User::inRandomOrder()->first()->id,
            'channel_id' => Channel::inRandomOrder()->first()->id,
            'title'      => $this->faker->word,
            'body'       => $this->faker->paragraph,
        ];
    }
}
