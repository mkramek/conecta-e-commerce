<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Regulation>
 */
class RegulationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->text(30),
            'slug' => fake()->slug(),
            'content' => fake()->text,
            'is_published' => fake()->boolean,
            'lang' => 'pl',
            'regulation_category_id' => 1
        ];
    }
}
