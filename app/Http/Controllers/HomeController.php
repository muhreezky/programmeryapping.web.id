<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Education;
use App\Models\Post;
use App\Models\Project;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Display the portfolio homepage.
     */
    public function index(): Response
    {
        return Inertia::render('Home', [
            'experiences' => Experience::ordered()
                ->get()
                ->each(fn (Experience $item) => $item->description = str($item->description)->sanitizeHtml()),
            'education' => Education::ordered()
                ->get()
                ->each(fn (Education $item) => $item->description = str($item->description)->sanitizeHtml()),
            'projects' => Project::ordered()
                ->get()
                ->each(fn (Project $item) => $item->description = str($item->description)->sanitizeHtml()),
            'latestPosts' => Post::with('author:id,name')
                ->latest()
                ->take(3)
                ->get(['id', 'title', 'slug', 'created_at']),
        ]);
    }
}
