@extends('filament-panels::pages.page')

@section('content')
    <div class="max-w-2xl mx-auto">
        <x-filament::section>
            <x-slot:heading>
                {{ $getTitle() }}
            </x-slot:heading>

            <x-slot:subheading>
                {{ $getSubheading() }}
            </x-slot:subheading>

            <x-slot:description>
                <form wire:submit="save" class="space-y-6">
                    @livewire($form)
                </form>
            </x-slot:description>

            <x-slot:footer>
                <x-filament::actions :actions="$getFormActions()" />
            </x-slot:footer>
        </x-filament::section>
    </div>
@endsection