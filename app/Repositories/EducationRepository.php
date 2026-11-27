<?php

namespace App\Repositories;

use App\Models\Education;
use Illuminate\Database\Eloquent\Collection;

class EducationRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return Education::class;
    }

    public function getAllOrdered(): Collection
    {
        return $this->query()->ordered()->get();
    }

    public function getCurrent(): Collection
    {
        return $this->query()->where('is_current', true)->ordered()->get();
    }

    public function getCompleted(): Collection
    {
        return $this->query()->where('is_current', false)->ordered()->get();
    }
}
