<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

abstract class BaseService
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
}
