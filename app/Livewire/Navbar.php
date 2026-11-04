<?php

namespace App\Livewire;

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
        return view('livewire.navbar');
    }
}