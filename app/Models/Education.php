<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    /** @use HasFactory<\Database\Factories\EducationFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'institution',
        'degree',
        'field_of_study',
        'description',
        'started_at',
        'ended_at',
        'is_current',
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
            'started_at' => 'date',
            'ended_at' => 'date',
            'is_current' => 'boolean',
            'sort_order' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Scope a query to order educations by sort_order and started_at desc.
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderByDesc('started_at');
    }

    /**
     * Scope a query to only include current educations.
     */
    public function scopeCurrent(Builder $query): Builder
    {
        return $query->where('is_current', true);
    }

    /**
     * Scope a query to only include completed educations.
     */
    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('is_current', false);
    }

    /**
     * Get the formatted period for display.
     */
    public function getPeriodAttribute(): string
    {
        $bulanIndo = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
            9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des',
        ];

        $start = $this->started_at ? $bulanIndo[$this->started_at->month].' '.$this->started_at->year : '';

        if ($this->is_current) {
            return $start.' — Sekarang';
        }

        $end = $this->ended_at ? ' — '.$bulanIndo[$this->ended_at->month].' '.$this->ended_at->year : '';

        return $start.$end;
    }

    /**
     * Check if education has a description.
     */
    public function hasDescription(): bool
    {
        return filled($this->description);
    }

    /**
     * Check if education has field of study.
     */
    public function hasFieldOfStudy(): bool
    {
        return filled($this->field_of_study);
    }
}
