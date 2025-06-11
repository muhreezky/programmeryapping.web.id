<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Navbar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class NavbarTest extends TestCase
{
    public function test_renders_successfully()
    {
        Livewire::test(Navbar::class)
            ->assertStatus(200)
            ->assertSee('Programmer Yapping');
    }
}
