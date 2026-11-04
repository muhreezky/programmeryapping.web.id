@extends('layouts.portfolio')

@section('title', 'Artikel — ' . config('app.name'))
@section('meta_description', 'Artikel dan catatan tulisan Muhammad Rizkiansyah seputar dunia pengembangan web.')

@php
    $bulanIndo = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'];
@endphp

@section('content')
    <div class="mx-auto max-w-5xl px-4 py-10 md:px-6">
        <div class="space-y-2">
            <x-ui.badge variant="outline" color="amber" icon="newspaper" size="sm">Blog</x-ui.badge>
            <x-ui.heading size="xl">Semua Artikel</x-ui.heading>
            <p class="text-base text-neutral-500 dark:text-neutral-400">
                Catatan, tutorial, dan cerita seputar pengembangan web dengan Laravel &amp; Livewire.
            </p>
        </div>

        <div class="mt-8 space-y-5">
            @forelse($posts as $post)
                <article class="group rounded-xl border border-black/10 bg-white p-5 shadow-xs transition duration-200 hover:-translate-y-0.5 hover:shadow-lg dark:border-white/10 dark:bg-neutral-900">
                    <div class="flex items-center gap-2 text-xs text-neutral-500 dark:text-neutral-400">
                        <x-ui.icon name="calendar" variant="micro" class="size-3.5" />
                        {{ $post->created_at->day . ' ' . $bulanIndo[$post->created_at->month] . ' ' . $post->created_at->year }}
                        @if ($post->author)
                            <span>&middot;</span>
                            <x-ui.avatar
                                :name="$post->author->name"
                                color="amber"
                                initials:single
                                size="xs"
                                alt=""
                            />
                            <span>{{ $post->author->name }}</span>
                        @endif
                    </div>

                    <h2 class="mt-3">
                        <a href="{{ route('posts.show', $post) }}"
                           class="text-xl font-semibold tracking-tight text-neutral-800 transition-colors group-hover:text-amber-700 dark:text-white dark:group-hover:text-amber-400">
                            {{ $post->title }}
                        </a>
                    </h2>
                    <p class="mt-2 line-clamp-3 text-sm leading-relaxed text-neutral-500 dark:text-neutral-400">
                        {{ Str::limit(strip_tags($post->content), 180) }}
                    </p>

                    <div class="mt-4">
                        <x-ui.link href="{{ route('posts.show', $post) }}" wire:navigate icon-after="arrow-long-right" class="text-sm">
                            Baca selengkapnya
                        </x-ui.link>
                    </div>
                </article>
            @empty
                <x-ui.empty class="py-16">
                    <x-ui.icon name="newspaper" class="size-10 text-amber-500" />
                    <x-ui.heading size="md" class="mt-3">Tidak ada artikel</x-ui.heading>
                    <x-ui.text class="mt-1 text-neutral-500 dark:text-neutral-400">
                        Artikel belum dipublikasikan. Coba lagi nanti!
                    </x-ui.text>
                </x-ui.empty>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
