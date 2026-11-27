<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected string $modelClass;

    public function __construct()
    {
        $this->modelClass = $this->getModelClass();
    }

    abstract protected function getModelClass(): string;

    protected function query(): Builder
    {
        return $this->modelClass::query();
    }

    public function find(int|string $id): ?Model
    {
        return $this->query()->find($id);
    }

    public function findOrFail(int|string $id): Model
    {
        return $this->query()->findOrFail($id);
    }

    public function findBy(string $field, mixed $value): ?Model
    {
        return $this->query()->where($field, $value)->first();
    }

    public function getAll(array $columns = ['*']): Collection
    {
        return $this->query()->get($columns);
    }

    public function paginate(int $perPage = 15, array $columns = ['*'], string $pageName = 'page', ?int $page = null): LengthAwarePaginator
    {
        return $this->query()->paginate($perPage, $columns, $pageName, $page);
    }

    public function create(array $data): Model
    {
        return $this->modelClass::create($data);
    }

    public function update(Model $model, array $data): Model
    {
        $model->update($data);

        return $model->fresh();
    }

    public function delete(Model $model): bool
    {
        return $model->delete();
    }

    public function bulkDelete(array $ids): int
    {
        return $this->query()->whereIn('id', $ids)->delete();
    }

    public function exists(string $field, mixed $value, ?int $excludeId = null): bool
    {
        $query = $this->query()->where($field, $value);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }
}
