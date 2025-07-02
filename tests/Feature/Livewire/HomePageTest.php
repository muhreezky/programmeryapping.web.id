<?php

namespace Tests\Feature\Livewire;

use App\Livewire\ContactForm;
use App\Livewire\Navbar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_renders_successfully()
    {
        // Judul harus programmer yapping
        Livewire::test(Navbar::class)
            ->assertStatus(200)
            ->assertSee('Programmer Yapping');
    }

    public function test_shows_message_form()
    {
        Livewire::test(ContactForm::class)
            ->assertStatus(200)
            ->assertFormExists('form');
    }
}
