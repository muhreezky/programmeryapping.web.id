<?php

namespace App\Providers;

use App\View\Composers\GlobalComposer;
use App\View\Composers\HomeComposer;
use App\View\Composers\PostComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Global settings available to all views
        View::composer('*', GlobalComposer::class);

        // Home page specific data
        View::composer('welcome', HomeComposer::class);

        // Post pages
        View::composer(['posts.show', 'posts.index', 'livewire.post'], PostComposer::class);
    }
}
