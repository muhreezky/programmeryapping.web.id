<?php

namespace App\Http\Controllers;

use App\Services\EducationService;
use App\Services\ExperienceService;
use App\Services\PostService;
use App\Services\ProjectService;
use App\Services\SettingService;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        protected ProjectService $projectService,
        protected ExperienceService $experienceService,
        protected EducationService $educationService,
        protected PostService $postService,
        protected SettingService $settingService
    ) {}

    public function index(): View
    {
        return view('welcome', [
            'settings' => $this->settingService->getSettings(),
            'projects' => $this->projectService->getAllOrdered(),
            'experiences' => $this->experienceService->getAllOrdered(),
            'educations' => $this->educationService->getAllOrdered(),
            'latestPosts' => $this->postService->getLatestPosts(3),
        ]);
    }
}
