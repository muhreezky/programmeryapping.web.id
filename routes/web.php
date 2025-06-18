<?php

use App\Livewire\BlogsPage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogPostController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return redirect('/admin/login');
});
Route::get('/posts', BlogsPage::class);
Route::get('/posts/{blog_post:slug}')->name('view-post');