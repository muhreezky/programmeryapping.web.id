<x-layouts.app>
    <x-hero-section />
    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
    <livewire:contact-form />
</x-layouts.app>