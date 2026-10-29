<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

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
        'author_id',
    ];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            fn ($value) => date('D M Y H:i:s T', strtotime($value))
        );
    }

    /**
     * Get the author of the post.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    protected static function booted()
    {
        static::creating(function (self $model) {
            if (empty($model->author_id) && Auth::id()) {
                $model->author()->associate(Auth::id());
            }

            $model->slug = Str::slug($model->title . '-' . Str::random(7));
        });
    }
}
