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
        $this->get('/')
            ->assertStatus(200)
            ->assertSee('Programmer Yapping');
    }

    public function test_shows_message_form()
    {
        Livewire::test(ContactForm::class)
            ->assertStatus(200)
            ->assertFormExists('form');
    }

    public function test_user_can_send_message()
    {
        Livewire::test(ContactForm::class)
            ->fillForm([
                'name' => fake()->name(),
                'email' => fake()->email(),
                'subject' => fake()->title(),
                'message' => fake()->realText()
            ]);
    }
}
