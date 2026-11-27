<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

class ProjectService extends BaseService
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

    public function getById(int $id): ?Project
    {
        return $this->find($id);
    }
}
