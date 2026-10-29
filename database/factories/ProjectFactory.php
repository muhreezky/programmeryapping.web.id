<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => ucfirst($this->faker->unique()->words(2, true)),
            'description' => $this->faker->paragraph(2),
            'url' => $this->faker->optional(0.6)->url,
            'image' => null,
            'tags' => $this->faker->randomElements(['Laravel', 'Vue', 'Svelte', 'React', 'Tailwind CSS', 'MySQL', 'PostgreSQL', 'Node.js', 'TypeScript', 'Inertia'], 3),
            'featured' => false,
            'sort_order' => 0,
        ];
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'featured' => true,
        ]);
    }
}
