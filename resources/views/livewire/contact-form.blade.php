@php
    /**
     * @var \App\Livewire\ContactForm $this
     **/
@endphp
<section class="p-6 bg-white border dark:bg-gray-800 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">
        Get in Touch
    </h2>

    <form wire:submit.prevent="submit" class="space-y-4">
        {{ $this->form }}

        <div class="flex justify-end">
            <x-filament::button type="submit">
                Kirim
            </x-filament::button>
        </div>
    </form>
</section>