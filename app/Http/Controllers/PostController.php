<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Posts/Index', [
            'posts' => Post::with('author:id,name')
                ->latest()
                ->paginate(20),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Post $post): Response
    {
        $post = $post->load(['author:id,name']);
        $post->content = str($post->content)->sanitizeHtml();

        return Inertia::render('Posts/Show', [
            'post' => $post,
        ]);
    }
}
