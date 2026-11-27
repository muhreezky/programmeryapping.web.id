<?php

namespace App\Livewire;

use App\Services\PostService;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.portfolio')]
#[Title('Artikel Saya')]
class PostPage extends Component
{
    use WithPagination;

    public string $search = '';

    public string $category = '';

    protected array $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
    ];

    protected PostService $postService;

    public function boot(): void
    {
        $this->postService = app(PostService::class);
    }

    public function mount(): void
    {
        $this->queryString['search'] = ['except' => ''];
        $this->queryString['category'] = ['except' => ''];
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedCategory(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $posts = $this->postService->getPostsForUser(
            auth()->user(),
            10,
            $this->search,
            $this->category
        );

        return view('livewire.post', ['posts' => $posts]);
    }
}
