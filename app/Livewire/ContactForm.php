<?php

namespace App\Livewire;

use App\Services\MessageService;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactForm extends Component
{
    #[Validate('required|string|max:255', as: 'nama')]
    public string $name = '';

    #[Validate('required|string|email|max:255', as: 'email')]
    public string $email = '';

    #[Validate('required|string|max:255', as: 'subjek')]
    public string $subject = '';

    #[Validate('required|string', as: 'pesan')]
    public string $message = '';

    public bool $success = false;

    public string $error = '';

    protected MessageService $messageService;

    public function boot(): void
    {
        $this->messageService = app(MessageService::class);
    }

    public function submit(): void
    {
        $this->validate();

        try {
            $this->messageService->createFromContactForm([
                'sender_name' => $this->name,
                'sender_email' => $this->email,
                'subject' => $this->subject,
                'content' => $this->message,
            ]);

            $this->success = true;
            $this->reset(['name', 'email', 'subject', 'message']);
            $this->error = '';
        } catch (\Exception $e) {
            $this->error = 'Gagal mengirim pesan: '.$e->getMessage();
            $this->success = false;
        }
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
