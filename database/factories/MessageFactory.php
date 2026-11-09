<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sender_name' => $this->faker->name(),
            'sender_email' => $this->faker->safeEmail(),
            'subject' => $this->faker->randomElement([
                'Peluang Kolaborasi Proyek',
                'Pertanyaan Tentang Portofolio',
                'Tawaran Kerja Sama Freelance',
                'Konsultasi Pengembangan Web',
                'Umpan Balik Untuk Blog',
            ]),
            'content' => $this->faker->paragraphs(3, true),
        ];
    }
}
