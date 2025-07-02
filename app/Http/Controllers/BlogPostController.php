<?php

namespace App\Http\Controllers;

use App\Models\BlogPost as Post;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('blog.list-view', [
            'blogs' => Post::latest()->paginate(20)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('blog.view-item', [
            'blog' => $post
        ]);
    }
}
