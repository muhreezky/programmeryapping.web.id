<?php

namespace App\Repositories;

use App\Models\Message;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MessageRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return Message::class;
    }

    public function getAllPaginated(int $perPage = 20): LengthAwarePaginator
    {
        return $this->query()->latest()->paginate($perPage);
    }
}
