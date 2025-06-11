<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogPostController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return redirect('/admin/login');
});

Route::resource('blog-posts', BlogPostController::class)
    ->scoped([
        'blog-post' => 'slug'
    ])
    ->only(['index', 'show']);
