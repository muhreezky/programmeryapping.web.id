@php
    /**
     * @var \App\Livewire\ContactForm $this
     **/
@endphp
<x-filament::section class="p-6 rounded-lg shadow-lg">
    <x-slot name="heading">
        Hubungi Kami
    </x-slot>
    <x-slot name="description">
        Punya kritik dan saran? Atau ada sesuatu yang ingin Anda sampaikan?
        Kirimkan kami pesan di sini, jangan sungkan-sungkan
    </x-slot>

    <form wire:submit.prevent="submit" class="space-y-4">
        {{ $this->form }}

        <div class="flex justify-end">
            <x-filament::button type="submit">
                Kirim
            </x-filament::button>
        </div>
    </form>
</x-filament::section>