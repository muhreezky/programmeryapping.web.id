<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Application Constants
    |--------------------------------------------------------------------------
    |
    | Centralized configuration for magic values used throughout the application.
    |
    */

    'pagination' => [
        'default_per_page' => 15,
        'posts_per_page' => 20,
        'admin_posts_per_page' => 10,
        'latest_posts_limit' => 3,
    ],

    'file_upload' => [
        'max_size' => 2048, // KB
        'allowed_types' => ['image/jpeg', 'image/png', 'image/webp'],
        'directories' => [
            'posts' => 'posts',
            'projects' => 'projects',
            'avatars' => 'avatars',
        ],
    ],

    'ui' => [
        'theme_colors' => [
            'primary' => 'amber',
            'secondary' => 'neutral',
        ],
        'avatar_sizes' => [
            'xs' => 'size-6',
            'sm' => 'size-8',
            'md' => 'size-10',
            'lg' => 'size-12',
            'xl' => 'size-16',
        ],
        'button_sizes' => ['sm', 'md', 'lg'],
        'button_variants' => ['primary', 'outline', 'ghost', 'secondary'],
    ],

    'skills' => [
        'Laravel',
        'Livewire',
        'Filament',
        'Alpine.js',
        'Tailwind CSS',
        'MySQL',
        'Redis',
        'Docker',
    ],

    'socials' => [
        [
            'href' => 'https://github.com/muhrizki',
            'icon' => 'code-bracket-square',
            'label' => 'GitHub',
        ],
        [
            'href' => 'https://linkedin.com/in/muhrizki',
            'icon' => 'link',
            'label' => 'LinkedIn',
        ],
        [
            'href' => 'mailto:admin@muhrizki.my.id',
            'icon' => 'envelope',
            'label' => 'Email',
        ],
    ],

    'indonesian_months' => [
        1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
        5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
        9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des',
    ],

    'date_formats' => [
        'short' => 'j F Y',
        'long' => 'j F Y H:i',
        'year_only' => 'Y',
        'month_year' => 'M Y',
    ],

    'excerpt_limits' => [
        'card' => 100,
        'list' => 110,
        'meta' => 150,
    ],

    'routes' => [
        'home' => 'home',
        'posts_index' => 'posts.index',
        'posts_show' => 'posts.show',
        'contact_store' => 'contact.store',
        'admin' => 'admin',
    ],

    'validation' => [
        'title_max' => 255,
        'content_min' => 10,
        'email_max' => 255,
        'name_max' => 255,
        'subject_max' => 255,
        'slug_random_length' => 7,
    ],

    'cache' => [
        'settings_ttl' => 3600, // 1 hour
    ],
];
