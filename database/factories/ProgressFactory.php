<?php

namespace Database\Factories;
use App\Models\Progress;
use App\Models\User;
use App\Models\Video;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Progress>
 */
class ProgressFactory extends Factory
{
    protected $model = Progress::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'video_id' => Video::factory(),
            'completed' => $this->faker->boolean,
            'last_viewed_at' => $this->faker->dateTimeThisYear,
        ];
    }
}
