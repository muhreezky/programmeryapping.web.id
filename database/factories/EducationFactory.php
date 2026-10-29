<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Education>
 */
class EducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $started = $this->faker->dateTimeBetween('-15 years', '-3 years');

        return [
            'institution' => $this->faker->randomElement(['Universitas Indonesia', 'Institut Teknologi Bandung (ITB)', 'Universitas Gadjah Mada (UGM)', 'Institut Teknologi Sepuluh Nopember (ITS)']),
            'degree' => $this->faker->randomElement(['Sarjana Ilmu Komputer', 'Sarjana Teknik Informatika', 'Sarjana Sistem Informasi']),
            'field_of_study' => $this->faker->randomElement(['Ilmu Komputer', 'Teknik Informatika', 'Rekayasa Perangkat Lunak', 'Sistem Informasi']),
            'description' => $this->faker->optional()->paragraph(2),
            'started_at' => $started,
            'ended_at' => $this->faker->optional(0.8)->dateTimeBetween($started, 'now'),
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
