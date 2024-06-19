<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SeoConfiguration>
 */
class SeoConfigurationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'meta_title' => fake()->text(20),
            'meta_author' => fake()->firstName . " " . fake()->lastName(),
            'meta_description_content' => fake()->realText(100),
            'meta_keywords' => strtolower('some, random, meta, keywords'),
            'lang' => 'pl'
        ];
    }
}
