<?php

namespace App\View\Composers;

use App\Services\SettingService;
use Illuminate\View\View;

class PostComposer
{
    public function __construct(
        protected SettingService $settingService
    ) {}

    public function compose(View $view): void
    {
        $view->with('globalSettings', $this->settingService->getSettings());
    }
}
