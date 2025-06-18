<?php

namespace App\Livewire;

use App\Models\BlogPost;
use Livewire\Component;

class ViewBlog extends Component
{
    public BlogPost $blogPost;
    public function mount(BlogPost $blogPost)
    {
        $this->blogPost = $blogPost;
    }

    public function render()
    {
        return view('livewire.view-blog');
    }
}
