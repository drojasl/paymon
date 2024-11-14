<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Video;
use App\Models\Course;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    protected $model = Video::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'url' => 'https://www.youtube.com/watch?v=' . $this->faker->regexify('[A-Za-z0-9_-]{11}'),
            'course_id' => Course::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
