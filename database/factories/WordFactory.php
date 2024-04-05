<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\Word;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Word>
 */
class WordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->text(50);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->paragraph(),

        ];
    }
}
