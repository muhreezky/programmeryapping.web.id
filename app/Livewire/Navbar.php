<?php

namespace App\Livewire;

use App\Services\SettingService;
use Livewire\Component;

class Navbar extends Component
{
    public bool $showMenu = false;

    protected SettingService $settingService;

    public function boot(): void
    {
        $this->settingService = app(SettingService::class);
    }

    public function toggleMenu(): void
    {
        $this->showMenu = ! $this->showMenu;
    }

    public function closeMenu(): void
    {
        $this->showMenu = false;
    }

    public function render()
    {
        return view('livewire.navbar', [
            'settings' => $this->settingService->getSettings(),
        ]);
    }
}
