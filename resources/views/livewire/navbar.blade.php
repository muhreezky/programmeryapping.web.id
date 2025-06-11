<div x-data="{ showMobile: false }" class="w-full bg-white rounded-b-md dark:bg-gray-800 shadow-md">
    @php
        $menus = [
            [
                'href' => '/',
                'label' => 'Home',
            ],
            [
                'href' => '/blog-posts',
                'label' => 'Artikel',
            ],
            [
                'href' => '/login',
                'label' => 'Login',
            ]
        ];
    @endphp
    <div class="flex items-center justify-between px-4 py-3 md:px-6">
        <!-- Logo / Brand -->
        <a href="/" class="text-xl font-bold text-gray-800 dark:text-white">
            {{ config('app.name') }}
        </a>

        <!-- Mobile Menu Button -->
        <button x-data x-on:click="showMobile = !showMobile"
            class="block md:hidden p-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none">
            <x-filament::icon icon="heroicon-o-bars-3" class="w-6 h-6 text-gray-800 dark:text-white" />
        </button>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex space-x-4">
            @foreach ($menus as $menu)
                <x-filament::link :href="$menu['href']" size="sm">
                    {{ $menu['label'] }}
                </x-filament::link>
            @endforeach
        </nav>
    </div>

    <!-- Mobile Navigation -->
    <nav x-show="showMobile" x-cloak class="md:hidden flex flex-col px-4 pb-3 pt-2 space-y-2">
        @foreach ($menus as $menu)
            <x-filament::button tag="a" :href="$menu['href']" full size="sm" :active="true">
                {{ $menu['label'] }}
            </x-filament::button>
        @endforeach
    </nav>
</div>