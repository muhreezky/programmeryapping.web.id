<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Schema;

class Settings extends Page
{
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static \UnitEnum|string|null $navigationGroup = 'Pengaturan';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament-panels::pages.page';

    public ?array $data = [];

    public function mount(): void
    {
        $this->data = Setting::getInstance()->toArray();
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([
                    TextInput::make('blog_name')
                        ->label('Nama Blog')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Muhrizki Blog'),

                    TextInput::make('short_description')
                        ->label('Deskripsi Singkat')
                        ->maxLength(255)
                        ->placeholder('Backend Developer & Laravel Artisan')
                        ->helperText('Ditampilkan di hero section dan navbar'),

                    Textarea::make('bio_description')
                        ->label('Bio Deskripsi')
                        ->rows(5)
                        ->placeholder('Saya membangun aplikasi web yang cepat, rapi, dan mudah dipelihara dengan Laravel...')
                        ->helperText('Ditampilkan di hero section halaman utama'),
                ])
                    ->statePath('data')
                    ->model(Setting::getInstance())
                    ->footer([
                        Action::make('save')
                            ->label('Simpan Perubahan')
                            ->icon('heroicon-o-check')
                            ->submit('save'),
                    ])
                    ->livewireSubmitHandler('save'),
            ]);
    }

    public function save(): void
    {
        $data = $this->data;
        Setting::getInstance()->update($data);

        Notification::make()
            ->success()
            ->title('Pengaturan disimpan')
            ->body('Perubahan telah berhasil disimpan.')
            ->send();
    }

    public function getTitle(): string
    {
        return 'Pengaturan Blog';
    }

    public function getSubheading(): ?string
    {
        return 'Kelola nama blog, deskripsi singkat, dan bio deskripsi';
    }
}
