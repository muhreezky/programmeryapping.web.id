<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct(
        protected PostService $postService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $posts = $this->postService->getPublicPosts(20);

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): View
    {
        $post = $this->postService->sanitizeContent($post);
        $post->load('author:id,name');

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        $this->postService->createPost($request->validated(), $request->user());

        return redirect()->route('posts.index')
            ->with('success', 'Artikel berhasil dibuat.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $this->postService->updatePost($post, $request->validated());

        return redirect()->route('posts.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $this->postService->delete($post);

        return redirect()->route('posts.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}
