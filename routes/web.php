<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/login', function () {
    return redirect('/admin/login');
});

Route::get('/storage/{fileName}', function(Request $request, string $fileName) {
  try {
    if (str_contains($fileName, '.php')) {
      throw new Error('Not Found');
    }
    return response()->file(storage_path("app/public/$fileName"), [
      'Access-Control-Allow-Origin' => '*',
      'Access-Control-Allow-Methods' => 'GET,OPTION'
    ]);
  } catch (\Throwable $th) {
    return response()->json(['message' => 'File Not Found'], 404);
  }
})->where('fileName', '.*');
