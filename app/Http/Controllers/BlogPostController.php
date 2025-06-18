<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;

class BlogPostController extends Controller
{
    public function index()
    {
        $blogs = BlogPost::paginate(20);
    }

    public function show(BlogPost $blogPost)
    {
        return $blogPost;
    }
}
