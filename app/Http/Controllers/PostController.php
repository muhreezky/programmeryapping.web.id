<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('author:id,name')
            ->latest()
            ->paginate(20);

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Post $post)
    {
        $post->load('author:id,name');
        $post->content = str($post->content)->sanitizeHtml();

        return view('posts.show', [
            'post' => $post,
        ]);
    }
}
