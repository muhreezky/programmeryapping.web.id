<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased min-h-screen flex flex-col bg-amber-50 dark:bg-gray-800">

    @livewire('navbar')

    <main class="mx-auto w-full max-w-5xl flex-1 space-y-12 px-4 py-8 md:px-6">
        @livewire('posts')
    </main>

    <footer class="border-t border-amber-200 bg-white py-6 dark:border-gray-700 dark:bg-gray-800">
        <div class="mx-auto flex max-w-5xl flex-col items-center justify-between gap-2 px-4 md:flex-row md:px-6">
            <p class="text-sm opacity-70">
                © {{ date('Y') }} {{ config('app.name') }} — Dibuat dengan Laravel, Filament, dan Livewire.
            </p>
            <nav class="flex gap-4 text-sm opacity-80">
                <a href="/" class="hover:underline">Beranda</a>
                <a href="/posts" class="hover:underline">Artikel</a>
                <a href="#kontak" class="hover:underline">Kontak</a>
            </nav>
        </div>
    </footer>

    @livewireScripts
</body>
</html>