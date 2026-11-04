<?php

namespace App\Http\Controllers;

use App\Livewire\PostPage;
use Livewire\Livewire;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Livewire::component('post-page', [
        //     'latestPosts' => app(PostPage::class)->latest()->take(3)->get(['id', 'title', 'slug', 'created_at']),
        // ]);

        return view('welcome');
    }
}