<?php

namespace App\Livewire;

use App\Models\Setting;
use Livewire\Component;

class Navbar extends Component
{
    public $showMenu = false;

    public function toggleMenu()
    {
        $this->showMenu = ! $this->showMenu;
    }

    public function render()
    {
        return view('livewire.navbar', [
            'settings' => Setting::getInstance(),
        ]);
    }
}
