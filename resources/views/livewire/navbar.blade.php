<nav
    class="sticky top-0 z-40 border-b border-amber-200/70 dark:border-white/10 bg-[#FAF7F2]/85 dark:bg-neutral-950/85 backdrop-blur supports-backdrop-filter:bg-[#FAF7F2]/70 dark:supports-backdrop-filter:bg-neutral-950/70">
    <div class="mx-auto flex h-16 max-w-5xl items-center justify-between px-4 md:px-6">

        <a href="{{ route('home') }}" class="flex items-center gap-2.5" wire:navigate>
            <x-ui.avatar initials="MR" color="amber" size="lg" alt="Logo {{ config('app.name') }}" />
            <span class="text-lg font-bold tracking-tight text-neutral-900 dark:text-white">
                {{ config('app.name') }}
            </span>
        </a>

        {{-- Desktop navigation --}}
        <div class="hidden md:flex items-center gap-1">
            <a href="{{ route('home') }}"
                class="text-sm font-medium px-3 py-2 rounded-field transition-colors text-neutral-700 hover:bg-amber-500/10 hover:text-amber-700 dark:text-neutral-300 dark:hover:text-amber-400"
                wire:navigate>
                Beranda
            </a>
            <a href="{{ route('home') }}#proyek"
                class="text-sm font-medium px-3 py-2 rounded-field transition-colors text-neutral-700 hover:bg-amber-500/10 hover:text-amber-700 dark:text-neutral-300 dark:hover:text-amber-400">
                Karya
            </a>
            <a href="{{ route('home') }}#pengalaman"
                class="text-sm font-medium px-3 py-2 rounded-field transition-colors text-neutral-700 hover:bg-amber-500/10 hover:text-amber-700 dark:text-neutral-300 dark:hover:text-amber-400">
                Pengalaman
            </a>
            <a href="{{ route('posts.index') }}"
                class="text-sm font-medium px-3 py-2 rounded-field transition-colors text-neutral-700 hover:bg-amber-500/10 hover:text-amber-700 dark:text-neutral-300 dark:hover:text-amber-400"
                wire:navigate>
                Artikel
            </a>

            <a href="{{ route('home') }}#kontak">
                <x-ui.button size="sm" variant="primary" as="a" icon-after="envelope" wire:navigate>
                    Hubungi
                </x-ui.button>
            </a>
        </div>

        <div class="flex items-center gap-2">
            <x-ui.theme-switcher variant="dropdown" />

            @if(auth()->user())
                <span class="hidden lg:inline text-sm text-neutral-500 dark:text-neutral-400">
                    {{ auth()->user()->name }}
                </span>
            @else
                <a href="/login"
                    class="hidden md:inline text-sm font-medium px-3 py-2 rounded-field text-neutral-700 hover:bg-amber-500/10 hover:text-amber-700 transition-colors dark:text-neutral-300 dark:hover:text-amber-400">
                    Masuk
                </a>
            @endif

            {{-- Mobile toggle --}}
            <button wire:click="toggleMenu"
                class="md:hidden p-2 rounded-field text-neutral-700 hover:bg-amber-500/10 transition-colors dark:text-neutral-300"
                aria-label="Buka menu">
                <svg class="size-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
</nav>

@if($showMenu)
    <div class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm md:hidden" wire:click="toggleMenu"></div>

    <div class="fixed top-0 right-0 z-50 flex h-full w-72 flex-col border-l border-amber-200/70 bg-[#FAF7F2] p-6 shadow-2xl dark:border-white/10 dark:bg-neutral-900 md:hidden"
        style="animation: slide-in 200ms ease-out">

        <button wire:click="toggleMenu"
            class="self-end p-2 rounded-field text-neutral-600 hover:bg-amber-500/10 transition-colors dark:text-neutral-300"
            aria-label="Tutup menu">
            <svg class="size-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="mt-4 flex flex-col gap-1">
            <a href="{{ route('home') }}" wire:navigate
                class="px-4 py-3 rounded-field text-neutral-800 font-medium hover:bg-amber-500/10 hover:text-amber-700 transition-colors dark:text-neutral-100 dark:hover:text-amber-400">
                Beranda
            </a>
            <a href="{{ route('home') }}#proyek" wire:click="toggleMenu"
                class="px-4 py-3 rounded-field text-neutral-800 font-medium hover:bg-amber-500/10 hover:text-amber-700 transition-colors dark:text-neutral-100 dark:hover:text-amber-400">
                Karya
            </a>
            <a href="{{ route('home') }}#pengalaman" wire:click="toggleMenu"
                class="px-4 py-3 rounded-field text-neutral-800 font-medium hover:bg-amber-500/10 hover:text-amber-700 transition-colors dark:text-neutral-100 dark:hover:text-amber-400">
                Pengalaman
            </a>
            <a href="{{ route('posts.index') }}" wire:navigate
                class="px-4 py-3 rounded-field text-neutral-800 font-medium hover:bg-amber-500/10 hover:text-amber-700 transition-colors dark:text-neutral-100 dark:hover:text-amber-400">
                Artikel
            </a>
            <a href="{{ route('home') }}#kontak" wire:click="toggleMenu"
                class="px-4 py-3 rounded-field text-neutral-800 font-medium hover:bg-amber-500/10 hover:text-amber-700 transition-colors dark:text-neutral-100 dark:hover:text-amber-400">
                Kontak
            </a>

            @if(auth()->user()->canAccessPanel(app('filament.panel')))
                <a href="/admin"
                    class="px-4 py-3 rounded-field text-amber-700 font-medium hover:bg-amber-500/10 transition-colors dark:text-amber-400">
                    Admin
                </a>
            @endif

            <a href="/login"
                class="px-4 py-3 rounded-field text-neutral-600 hover:bg-amber-500/10 transition-colors dark:text-neutral-400">
                {{ auth()->check() ? 'Keluar' : 'Masuk' }}
            </a>
        </div>
    </div>
@endif