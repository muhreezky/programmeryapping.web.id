<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PostRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return Post::class;
    }

    public function getLatestPosts(int $limit = 3): Collection
    {
        return $this->query()
            ->with('author:id,name')
            ->latest()
            ->take($limit)
            ->get();
    }

    public function getPublicPosts(int $perPage = 20): LengthAwarePaginator
    {
        return $this->query()
            ->with('author:id,name')
            ->latest()
            ->paginate($perPage);
    }

    public function getPostWithAuthor(int|string $id): ?Post
    {
        return $this->query()->with('author:id,name')->find($id);
    }

    public function getPostBySlug(string $slug): ?Post
    {
        return $this->query()->with('author:id,name')->where('slug', $slug)->first();
    }

    public function getPostsForUser(User $user, int $perPage = 10, string $search = '', string $category = ''): LengthAwarePaginator
    {
        $query = $this->query()->where('author_id', $user->id);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if ($category) {
            $query->where('category', $category);
        }

        return $query->latest()->paginate($perPage);
    }
}
