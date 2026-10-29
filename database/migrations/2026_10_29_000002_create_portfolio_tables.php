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
        if (! Schema::hasTable('experiences')) {
            Schema::create('experiences', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('company');
                $table->string('employment_type')->nullable();
                $table->text('description')->nullable();
                $table->date('started_at');
                $table->date('ended_at')->nullable();
                $table->boolean('is_current')->default(false);
                $table->unsignedInteger('sort_order')->default(0);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('education')) {
            Schema::create('education', function (Blueprint $table) {
                $table->id();
                $table->string('institution');
                $table->string('degree');
                $table->string('field_of_study')->nullable();
                $table->text('description')->nullable();
                $table->date('started_at');
                $table->date('ended_at')->nullable();
                $table->boolean('is_current')->default(false);
                $table->unsignedInteger('sort_order')->default(0);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('projects')) {
            Schema::create('projects', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description');
                $table->string('url')->nullable();
                $table->string('image')->nullable();
                $table->json('tags')->nullable();
                $table->boolean('featured')->default(false);
                $table->unsignedInteger('sort_order')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
        Schema::dropIfExists('education');
        Schema::dropIfExists('experiences');
    }
};
