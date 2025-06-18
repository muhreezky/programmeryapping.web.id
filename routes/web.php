<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogPostController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return redirect('/admin/login');
});

Route::resource('posts', BlogPostController::class)
    ->scoped([
        'post' => 'slug',
    ])
    ->only(['index', 'show']);