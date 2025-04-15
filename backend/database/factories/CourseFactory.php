<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       
        
            $courseNames = ['BSIT', 'BS-SS', 'BS-MATH', 'BS-ENTREP'];
            
            $name = $this->faker->unique()->randomElement($courseNames);
            
            return [
                'course_name' => $name,
            ];
        
    }
}
