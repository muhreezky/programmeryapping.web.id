<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class PostService extends BaseService
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

    public function createPost(array $data, User $author): Post
    {
        $data['author_id'] = $author->id;
        $data['slug'] = Str::slug($data['title'].'-'.Str::random(7));

        return $this->create($data);
    }

    public function updatePost(Post $post, array $data): Post
    {
        if (isset($data['title']) && $data['title'] !== $post->title) {
            $data['slug'] = Str::slug($data['title'].'-'.Str::random(7));
        }

        return $this->update($post, $data);
    }

    public function sanitizeContent(Post $post): Post
    {
        $post->content = str($post->content)->sanitizeHtml();

        return $post;
    }
}
