<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostPage extends Component
{
    public $search = '';
    public $category = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
    ];

    public function mount()
    {
        $this->queryString['search'] = ['except' => ''];
        $this->queryString['category'] = ['except' => ''];
    }

    public function render()
    {
        $query = Post::where('author_id', auth()->id());

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('content', 'like', '%' . $this->search . '%');
            });
        }

        $post = $query->latest()->paginate(10);

        return view('livewire.post', ['post' => $post]);
    }
}