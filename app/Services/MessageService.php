<?php

namespace App\Services;

use App\Models\Message;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MessageService extends BaseService
{
    protected function getModelClass(): string
    {
        return Message::class;
    }

    public function getAllPaginated(int $perPage = 20): LengthAwarePaginator
    {
        return $this->query()->latest()->paginate($perPage);
    }

    public function createFromContactForm(array $data): Message
    {
        return $this->create($data);
    }
}
