<?php

namespace App\Repositories;

use App\Models\Experience;
use Illuminate\Database\Eloquent\Collection;

class ExperienceRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return Experience::class;
    }

    public function getAllOrdered(): Collection
    {
        return $this->query()->ordered()->get();
    }

    public function getCurrent(): Collection
    {
        return $this->query()->where('is_current', true)->ordered()->get();
    }

    public function getPast(): Collection
    {
        return $this->query()->where('is_current', false)->ordered()->get();
    }
}
