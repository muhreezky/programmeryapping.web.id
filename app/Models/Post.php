<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'headline_image',
        'author_id',
        'slug',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'headline_image' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the author of the post.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get the formatted created date for display.
     */
    protected function formattedCreatedAt(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->created_at?->translatedFormat('j F Y')
        );
    }

    /**
     * Get the excerpt of the post content.
     */
    protected function excerpt(int $limit = 110): Attribute
    {
        return Attribute::make(
            get: fn () => Str::limit(strip_tags($this->content), $limit)
        );
    }

    /**
     * Get the sanitized HTML content.
     */
    protected function sanitizedContent(): Attribute
    {
        return Attribute::make(
            get: fn () => str($this->content)->sanitizeHtml()
        );
    }

    /**
     * Scope a query to only include posts for a specific author.
     */
    public function scopeForAuthor($query, int $authorId)
    {
        return $query->where('author_id', $authorId);
    }

    /**
     * Scope a query to order posts by latest first.
     */
    public function scopeLatestFirst($query)
    {
        return $query->latest();
    }

    /**
     * Scope a query to search posts by title or content.
     */
    public function scopeSearch($query, string $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
        });
    }

    /**
     * Boot the model.
     */
    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (empty($model->author_id) && auth()->id()) {
                $model->author_id = auth()->id();
            }

            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title.'-'.Str::random(7));
            }
        });

        static::updating(function (self $model) {
            if ($model->isDirty('title') && empty($model->getOriginal('slug'))) {
                $model->slug = Str::slug($model->title.'-'.Str::random(7));
            }
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
