<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Post;
use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'projects' => Project::ordered()->get(),
            'experiences' => Experience::orderBy('sort_order')
                ->orderByDesc('started_at')
                ->get(),
            'educations' => Education::orderBy('sort_order')
                ->orderByDesc('started_at')
                ->get(),
            'latestPosts' => Post::with('author:id,name')
                ->latest()
                ->take(3)
                ->get(),
        ]);
    }
}
