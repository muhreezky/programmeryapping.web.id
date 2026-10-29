<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('blog_posts') && ! Schema::hasTable('posts')) {
            Schema::rename('blog_posts', 'posts');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('posts') && ! Schema::hasTable('blog_posts')) {
            Schema::rename('posts', 'blog_posts');
        }
    }
};
