<?php

namespace Tests;

use App\Livewire\PostPage;
use App\Providers\Filament\AdminPanelProvider;
use Filament\Facades\Filament;
use Filament\Panel;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Livewire\Livewire;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Register Filament panel for tests
        $panelProvider = new AdminPanelProvider($this->app);
        $panel = $panelProvider->panel(app(Panel::class));
        Filament::registerPanel($panel);
        Filament::setCurrentPanel('admin');

        // Register Livewire components for tests
        Livewire::component('posts', PostPage::class);
    }
}
