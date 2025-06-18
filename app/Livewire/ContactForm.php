<?php

namespace App\Livewire;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class ContactForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()->label('Nama')
                    ->maxLength(255)
                    ->placeholder('Nama Anda'),
                    
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->placeholder('E-mail aktif Anda'),
                    
                TextInput::make('subject')
                    ->required()->label('Judul Pesan')
                    ->columnSpanFull()
                    ->maxLength(255)
                    ->placeholder('Tulis Judul Pesan'),
                    
                Textarea::make('message')
                    ->required()->label('Pesan')
                    ->placeholder('Pesan Anda untuk Kami')
                    ->columnSpanFull(),
            ])
            ->statePath('data')
            ->columns(2);
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}