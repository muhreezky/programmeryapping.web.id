<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

class ProjectRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return Project::class;
    }

    public function getAllOrdered(): Collection
    {
        return $this->query()->ordered()->get();
    }

    public function getFeatured(): Collection
    {
        return $this->query()->where('featured', true)->ordered()->get();
    }
}
