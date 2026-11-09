<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description"
        content="@yield('meta_description', 'Portofolio Muhammad Rizkiansyah — Backend Developer yang membangun aplikasi web dengan Laravel, Livewire, dan Filament.')" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css'])

    <script>
        // Load dark mode before page renders to prevent flicker (Sheaf UI dark mode system)
        const loadDarkMode = () => {
            const theme = localStorage.getItem('theme') ?? 'system'

            if (
                theme === 'dark' ||
                (theme === 'system' &&
                    window.matchMedia('(prefers-color-scheme: dark)').matches)
            ) {
                document.documentElement.classList.add('dark')
            }
        }

        loadDarkMode()

        // Reinitialize after Livewire navigation (SPA mode)
        document.addEventListener('livewire:navigated', () => loadDarkMode())
    </script>
    @livewireStyles
</head>

<body
    class="antialiased min-h-screen flex flex-col bg-[#FAF7F2] text-neutral-800 dark:bg-neutral-950 dark:text-neutral-200 selection:bg-amber-200/70 selection:text-amber-950 dark:selection:bg-amber-400/30 dark:selection:text-amber-100">

    @livewire('navbar')

    <main class="flex-1">
        @yield('content')
    </main>

    <footer
        class="mt-16 border-t border-amber-200/70 bg-white/60 backdrop-blur py-8 dark:border-white/10 dark:bg-neutral-950/60">
        <div class="mx-auto flex max-w-5xl flex-col items-center justify-between gap-4 px-4 md:flex-row md:px-6">
            <p class="text-sm text-neutral-500 dark:text-neutral-400">
                &copy; {{ date('Y') }} {{ config('app.name') }} &mdash; dibangun dengan Laravel &amp; Livewire.
            </p>

            <nav class="flex flex-wrap items-center justify-center gap-x-5 gap-y-2 text-sm">
                <a href="{{ route('home') }}"
                    class="text-neutral-600 hover:text-amber-600 transition-colors dark:text-neutral-400 dark:hover:text-amber-400">Beranda</a>
                <a href="{{ route('home') }}#proyek"
                    class="text-neutral-600 hover:text-amber-600 transition-colors dark:text-neutral-400 dark:hover:text-amber-400">Karya</a>
                <a href="{{ route('posts.index') }}"
                    class="text-neutral-600 hover:text-amber-600 transition-colors dark:text-neutral-400 dark:hover:text-amber-400">Artikel</a>
                <a href="{{ route('home') }}#kontak"
                    class="text-neutral-600 hover:text-amber-600 transition-colors dark:text-neutral-400 dark:hover:text-amber-400">Kontak</a>

                @if(auth()->check())
                    <a href="{{ url('/admin') }}"
                        class="text-neutral-600 hover:text-amber-600 transition-colors dark:text-neutral-400 dark:hover:text-amber-400">Admin</a>
                @endif
            </nav>
        </div>
    </footer>

    @livewireScripts

    {{-- Sheaf UI global state ($theme magic property) must init after Livewire ships its Alpine build --}}
    @vite(['resources/js/app.js'])

    <script>
        loadDarkMode()
    </script>
</body>

</html>