<?php

namespace App\Livewire;

use App\Models\BlogPost;
use Livewire\Attributes\Url;
use Livewire\Component;

class BlogsPage extends Component
{
    // public $blogs;

    #[Url]
    public $page = 1;

    public function mount($page = 1)
    {
        // $blogs = BlogPost::paginate(20);
        // $this->blogs = $blogs->toArray();
    }

    public function render()
    {
        $blogs = BlogPost::paginate(20);
        return view('livewire.blogs-page', compact('blogs'));
    }
}
