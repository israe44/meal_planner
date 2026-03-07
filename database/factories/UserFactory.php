<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(), //fake first name
            'last_name' => fake()->lastName(), //fake last name
            'email' => fake()->unique()->safeEmail(), //unique fake email
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'), //same hashed password 
            'remember_token' => Str::random(10), //remember me token
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
