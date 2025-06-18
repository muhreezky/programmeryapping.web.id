<!DOCTYPE html>
<html x-data="{ isThemeDark: false }" :class="{ 'dark': isThemeDark }" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />

        <meta name="application-name" content="{{ config('app.name') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{{ config('app.name') }}</title>

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        @filamentStyles
        @vite('resources/css/app.css')
    </head>

    <body class="antialiased dark:bg-gray-800 bg-primary min-h-screen flex flex-col">
        @livewire('navbar')
        <main class="px-5 py-4 space-y-5 flex-1">
            {{ $slot }}
        </main>
        @livewire('footer')

        @filamentScripts
        @vite('resources/js/app.js')
    </body>
</html>
