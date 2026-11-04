<?php

namespace Tests\Feature\Livewire;

use App\Livewire\ContactForm;
use App\Livewire\Navbar;
use App\Livewire\PostPage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_renders_successfully()
    {
        $this->get('/')
            ->assertStatus(200)
            ->assertSee('Muhammad Rizkiansyah')
            ->assertSeeLivewire('posts');
    }

    public function test_shows_message_form()
    {
        Livewire::test(ContactForm::class)
            ->assertStatus(200)
            ->assertSet('name', '')
            ->assertSet('email', '')
            ->assertSet('subject', '')
            ->assertSet('message', '')
            ->assertSet('success', false)
            ->assertSet('error', '');
    }

    public function test_user_can_send_message()
    {
        $form = [
            'name' => fake()->name(),
            'email' => fake()->email(),
            'subject' => fake()->title(),
            'message' => fake()->realText(),
        ];

        Livewire::test(ContactForm::class)
            ->set('name', $form['name'])
            ->set('email', $form['email'])
            ->set('subject', $form['subject'])
            ->set('message', $form['message'])
            ->call('submit')
            ->assertSet('success', true)
            ->assertSet('name', '')
            ->assertSet('email', '')
            ->assertSet('subject', '')
            ->assertSet('message', '');

        $this->assertDatabaseHas('messages', [
            'sender_name' => $form['name'],
            'sender_email' => $form['email'],
            'subject' => $form['subject'],
        ]);
    }
}
