<nav class="flex items-center justify-between px-4 py-3 border-b border-amber-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
    <div class="flex items-center gap-3">
        <a href="/"
            class="text-xl font-bold text-amber-800 dark:text-amber-200"
            wire:navigate>
            Muhammad Rizkiansyah
        </a>
    </div>

    <div class="hidden md:block items-center gap-6">
        <a href="/"
            class="text-sm font-medium opacity-80 hover:text-amber-600 transition-colors"
            wire:navigate>
            Beranda
        </a>
        <a href="/posts"
            class="text-sm font-medium opacity-80 hover:text-amber-600 transition-colors"
            wire:navigate>
            Artikel
        </a>

        @if(auth()->user())
            <span class="text-sm font-medium opacity-80">
                {{ auth()->user()->name }}
            </span>
        @else
            <a href="/login"
                class="text-sm font-medium opacity-80 hover:text-amber-600 transition-colors">
                Masuk
            </a>
        @endif
    </div>

    <button wire:click="toggleMenu"
        class="md:hidden p-2"
        aria-label="Toggle menu">
        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>
</nav>

@if(auth()->user() && !$showMenu)
<div class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden md:hidden" wire:click="toggleMenu">
</div>
@endif

@if($showMenu)
<div class="fixed inset-0 z-40 flex flex-col items-center justify-start bg-white shadow-2xl w-64 md:w-80 pt-16 pointer-events-auto">
    <button wire:click="toggleMenu"
        class="absolute top-4 right-4 p-2"
        aria-label="Close menu">
        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
    <a href="/"
        class="block px-4 py-2 text-left text-amber-800 hover:bg-amber-50 mb-2">
        Beranda
    </a>
    <a href="/posts"
        class="block px-4 py-2 text-left text-amber-800 hover:bg-amber-50 mb-2">
        Artikel
    </a>
    @if(auth()->user()->canAccessPanel(app('filament.panel')))
        <a href="/admin"
            class="block px-4 py-2 text-left text-amber-800 hover:bg-amber-50 mb-2">
            Admin
        </a>
    @endif
    <a href="/login"
        class="block px-4 py-2 text-left text-amber-800 hover:bg-amber-50 mb-2">
        @if(auth()->check())
            Keluar
        @else
            Masuk
        @endif
    </a>
</div>
@endif
