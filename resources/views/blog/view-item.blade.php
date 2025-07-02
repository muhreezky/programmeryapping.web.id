@props([
    'blog',
])
@php
  use Illuminate\Support\Facades\Storage;
@endphp
<x-layouts.app>
  <x-filament::section>
    <x-slot name="heading">
      <h1 class="text-2xl font-bold">
        {{ $blog->title }}
      </h1>
    </x-slot>
    <x-slot name="description">
      {{ $blog->author->name }} <br />
      {{ $blog->created_at }}
    </x-slot>
    <div class="flex flex-col gap-4 px-3 md:px-12">
      <section class="text-center">
        <img class="object-scale-down max-w-full" src="{{ Storage::disk('public')->url($blog->headline_image) }}" />
      </section>
      <section>
        {!! str($blog->content)->sanitizeHtml() !!}
      </section>
    </div>
  </x-filament::section>
</x-layouts.app>