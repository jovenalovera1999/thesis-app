<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'full_name' => fake()->name(),
            'strand_id' => fake()->numberBetween(1, 5),
            'section_id' => fake()->numberBetween(1, 10),
            'teacher_id' => fake()->numberBetween(1, 8),
            'student_id_no' => fake()->ean8(),
            'password' => bcrypt('123')
        ];
    }
}
