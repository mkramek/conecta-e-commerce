<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FirstLevelCategory>
 */
class FirstLevelCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_pl' => fake()->text,
            'name_en' => fake()->text,
            'slug_pl' => Str::slug(fake()->text),
            'slug_en' => Str::slug(fake()->text),
            'description_pl' => fake()->text(150),
            'description_en' => fake()->text(150),
            'keywords_pl' => "jakies, losowe, slowa kluczowe, w, polskim, jezyku",
            'keywords_en' => "some, random, keywords, in, english, language",
            'has_second_level_categories' => fake()->boolean,
            'has_active_promotion' => false,
            'position' => fake()->randomNumber(2),
            'display_in_menu' => fake()->boolean
        ];
    }
}
