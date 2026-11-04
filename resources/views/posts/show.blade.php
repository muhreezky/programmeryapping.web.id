@extends('layouts.portfolio')

@section('title', $post->title . ' — ' . config('app.name'))
@section('meta_description', Str::limit(strip_tags($post->content), 150))

@php
    $bulanIndo = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'];
    $createdAt = \Illuminate\Support\Carbon::parse($post->created_at);
@endphp

@section('content')
    <div class="mx-auto max-w-5xl px-4 py-10 md:px-6">
        <a href="{{ route('posts.index') }}" wire:navigate
           class="inline-flex items-center gap-1.5 text-sm font-medium text-amber-700 transition-colors hover:text-amber-600 dark:text-amber-400 dark:hover:text-amber-300">
            <x-ui.icon name="arrow-long-left" variant="micro" class="size-4" />
            Kembali ke daftar artikel
        </a>

        @if ($post->headline_image)
            <img
                src="{{ \Illuminate\Support\Facades\Storage::url($post->headline_image) }}"
                alt="Gambar utama {{ $post->title }}"
                class="mt-6 aspect-video w-full rounded-xl border border-black/10 object-cover dark:border-white/10"
            />
        @endif

        <article class="mt-8 max-w-3xl">
            <div class="space-y-3">
                <div class="flex flex-wrap items-center gap-3 text-xs text-neutral-500 dark:text-neutral-400">
                    <span class="inline-flex items-center gap-1.5">
                        <x-ui.icon name="calendar" variant="micro" class="size-3.5" />
                        {{ $createdAt->day . ' ' . $bulanIndo[$createdAt->month] . ' ' . $createdAt->year }}
                    </span>
                    @if ($post->author)
                        <span class="inline-flex items-center gap-2">
                            <x-ui.avatar
                                :name="$post->author->name"
                                color="amber"
                                initials:single
                                size="xs"
                                alt=""
                            />
                            {{ $post->author->name }}
                        </span>
                    @endif
                </div>

                <x-ui.heading level="h1" size="xl" class="tracking-tight">
                    {{ $post->title }}
                </x-ui.heading>
            </div>

            <div class="prose prose-amber prose-headings:font-semibold prose-headings:tracking-tight prose-a:text-amber-700 dark:prose-a:text-amber-400 dark:prose-invert mt-8 max-w-none">
                {!! $post->content !!}
            </div>
        </article>
    </div>
@endsection
