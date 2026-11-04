<?php

namespace App\Livewire;

use App\Models\Message;
use Livewire\Component;

class ContactForm extends Component
{
    public $name = '';
    public $email = '';
    public $subject = '';
    public $message = '';
    public $success = false;
    public $error = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ];

    public function submit()
    {
        $this->validate();

        try {
            Message::create([
                'sender_name' => $this->name,
                'sender_email' => $this->email,
                'subject' => $this->subject,
                'content' => $this->message,
            ]);

            $this->success = true;
            $this->reset(['name', 'email', 'subject', 'message']);
        } catch (\Exception $e) {
            $this->error = 'Gagal mengirim pesan: ' . $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}