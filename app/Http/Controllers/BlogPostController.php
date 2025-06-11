<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;

class BlogPostController extends Controller
{
    public function index()
    {
        return BlogPost::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author_id' => 'required|exists:users,id',
        ]);

        return BlogPost::create($validated);
    }

    public function show(BlogPost $blogPost)
    {
        return $blogPost;
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'author_id' => 'sometimes|required|exists:users,id',
        ]);

        $blogPost->update($validated);

        return $blogPost;
    }

    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();

        return response()->noContent();
    }
}
