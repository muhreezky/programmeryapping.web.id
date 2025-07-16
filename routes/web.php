<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogPostController;

Route::get('/', function () {
    return view('welcome');
});
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

Route::resource('posts', BlogPostController::class)
    ->scoped([
        'post' => 'slug',
    ])
    ->only(['index', 'show']);