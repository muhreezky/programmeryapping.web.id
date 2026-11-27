<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'blog_name',
        'short_description',
        'bio_description',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'blog_name' => 'string',
            'short_description' => 'string',
            'bio_description' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the singleton settings instance.
     */
    public static function getInstance(): self
    {
        return self::firstOrCreate([], [
            'blog_name' => 'Muhrizki Blog',
            'short_description' => 'Backend Developer & Laravel Artisan',
            'bio_description' => 'Saya membangun aplikasi web yang cepat, rapi, dan mudah dipelihara dengan Laravel — mulai dari REST API, admin panel dengan Filament, hingga antarmuka reaktif berbasis Livewire dan Alpine.js. Tulis sekali, jalan terus.',
        ]);
    }

    /**
     * Get the blog name with fallback.
     */
    public function getBlogName(): string
    {
        return $this->blog_name ?? config('app.name');
    }

    /**
     * Get the short description with fallback.
     */
    public function getShortDescription(): string
    {
        return $this->short_description ?? 'Backend Developer';
    }

    /**
     * Get the bio description with fallback.
     */
    public function getBioDescription(): string
    {
        return $this->bio_description ?? '';
    }
}
