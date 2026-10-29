<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Experience>
 */
class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $started = $this->faker->dateTimeBetween('-10 years', '-1 years');

        return [
            'title' => $this->faker->randomElement(['Backend Developer', 'Fullstack Developer', 'Web Developer', 'Junior Software Engineer']),
            'company' => $this->faker->company,
            'employment_type' => $this->faker->randomElement(['Full-time', 'Part-time', 'Freelance', 'Internship']),
            'description' => $this->faker->paragraph(3),
            'started_at' => $started,
            'ended_at' => $this->faker->optional(0.7)->dateTimeBetween($started, 'now'),
            'is_current' => false,
            'sort_order' => 0,
        ];
    }

    public function current(): static
    {
        return $this->state(fn (array $attributes) => [
            'ended_at' => null,
            'is_current' => true,
        ]);
    }
}
