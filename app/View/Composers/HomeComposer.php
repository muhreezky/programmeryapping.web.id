<?php

namespace App\View\Composers;

use App\Services\EducationService;
use App\Services\ExperienceService;
use App\Services\PostService;
use App\Services\ProjectService;
use App\Services\SettingService;
use Illuminate\View\View;

class HomeComposer
{
    public function __construct(
        protected ProjectService $projectService,
        protected ExperienceService $experienceService,
        protected EducationService $educationService,
        protected PostService $postService,
        protected SettingService $settingService
    ) {}

    public function compose(View $view): void
    {
        $view->with([
            'settings' => $this->settingService->getSettings(),
            'projects' => $this->projectService->getAllOrdered(),
            'experiences' => $this->experienceService->getAllOrdered(),
            'educations' => $this->educationService->getAllOrdered(),
            'latestPosts' => $this->postService->getLatestPosts(3),
            'skills' => $this->getSkills(),
            'socials' => $this->getSocials(),
        ]);
    }

    protected function getSkills(): array
    {
        return [
            'Laravel',
            'Livewire',
            'Filament',
            'Alpine.js',
            'Tailwind CSS',
            'MySQL',
            'Redis',
            'Docker',
        ];
    }

    protected function getSocials(): array
    {
        return [
            ['href' => 'https://github.com/muhrizki', 'icon' => 'code-bracket-square', 'label' => 'GitHub'],
            ['href' => 'https://linkedin.com/in/muhrizki', 'icon' => 'link', 'label' => 'LinkedIn'],
            ['href' => 'mailto:admin@muhrizki.my.id', 'icon' => 'envelope', 'label' => 'Email'],
        ];
    }
}
