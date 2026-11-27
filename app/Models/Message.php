<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /** @use HasFactory<\Database\Factories\MessageFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sender_email',
        'sender_name',
        'subject',
        'content',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'sender_email' => 'string',
            'sender_name' => 'string',
            'subject' => 'string',
            'content' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the sender's initials for avatar.
     */
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', trim($this->sender_name));
        $initials = '';

        foreach ($words as $word) {
            $initials .= mb_substr($word, 0, 1);
        }

        return strtoupper($initials);
    }

    /**
     * Get the formatted created date for display.
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->created_at?->translatedFormat('j F Y H:i') ?? '';
    }
}
