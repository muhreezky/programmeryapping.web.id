<?php

namespace App\View\Components\BlogItem;

use App\Models\BlogPost;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BlogCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $href,
        public BlogPost $item,
    )
    {
        $this->item->load('author');
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.blog-item.blog-card');
    }
}
