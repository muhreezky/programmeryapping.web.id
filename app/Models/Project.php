<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'url',
        'image',
        'tags',
        'featured',
        'sort_order',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'featured' => 'boolean',
            'sort_order' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Scope a query to order projects by featured first, then sort_order.
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('featured', 'desc')->orderBy('sort_order');
    }

    /**
     * Scope a query to only include featured projects.
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('featured', true);
    }

    /**
     * Get the URL or return null if not set.
     */
    public function getUrlOrNull(): ?string
    {
        return $this->url ?: null;
    }

    /**
     * Check if project has an image.
     */
    public function hasImage(): bool
    {
        return filled($this->image);
    }

    /**
     * Check if project has tags.
     */
    public function hasTags(): bool
    {
        return filled($this->tags);
    }
}
