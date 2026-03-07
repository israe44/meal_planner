<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), //user_id needs to be a real id from users table
            'name' => fake()->words(3, true), //fake meal name of 3 random words
            'description' => fake()->text(),
            'category' =>fake()->randomElement(['breakfast', 'lunch', 'dinner', 'snack']),
        ];
    }
}
