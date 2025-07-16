<?php

namespace Tests\Feature\Filament\Resources;

use App\Filament\Resources\BlogPostResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class BlogPostResourceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        Livewire::test(BlogPostResource::class);
    }
}
