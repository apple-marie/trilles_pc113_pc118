<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'age' => $this->faker->numberBetween(16, 25),
            'course_id' => Course::inRandomOrder()->first()?->id ?? 1, // assumes you have a Course model
            'year_level' => $this->faker->randomElement(['1st Year', '2nd Year', '3rd Year', '4th Year']),
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'), // or bcrypt('password')
            'description' => $this->faker->optional()->paragraph,
            
        ];
    }
}
