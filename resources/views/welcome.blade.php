@extends('layouts.portfolio')

@section('title', 'Muhammad Rizkiansyah — Backend Developer & Laravel Artisan')

@php
    /**
     * Data & format helper (locale Indonesia).
     */
    $bulanIndo = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'];
    $fmt = fn ($date) => $bulanIndo[$date->month] . ' ' . $date->year;
    $period = fn ($item) => $fmt($item->started_at)
        . ($item->is_current ? ' — Sekarang' : (! empty($item->ended_at) ? ' — ' . $fmt($item->ended_at) : ''));

    $skills = ['Laravel', 'Livewire', 'Filament', 'Alpine.js', 'Tailwind CSS', 'MySQL', 'Redis', 'Docker'];
    $socials = [
        ['href' => 'https://github.com/muhrizki', 'icon' => 'code-bracket-square', 'label' => 'GitHub'],
        ['href' => 'https://linkedin.com/in/muhrizki', 'icon' => 'link', 'label' => 'LinkedIn'],
        ['href' => 'mailto:admin@muhrizki.my.id', 'icon' => 'envelope', 'label' => 'Email'],
    ];

    $projectUrl = fn ($project) => $project->url ?: null;
@endphp

@section('content')
    {{-- ================================================== HERO ================================================== --}}
    <section id="beranda" class="relative overflow-hidden">
        <div class="pointer-events-none absolute -top-24 right-[-10%] h-96 w-96 rounded-full bg-amber-300/30 blur-3xl dark:bg-amber-500/10"></div>
        <div class="pointer-events-none absolute top-40 left-[-12%] h-72 w-72 rounded-full bg-orange-200/40 blur-3xl dark:bg-amber-800/10"></div>

        <div class="relative mx-auto flex max-w-5xl flex-col-reverse items-start gap-10 px-4 pb-16 pt-16 md:flex-row md:items-center md:px-6 md:pt-24">
            <div class="max-w-2xl space-y-5">
                <x-ui.badge variant="outline" color="amber" icon="sparkles" size="sm">
                    Tersedia untuk proyek baru
                </x-ui.badge>

                <div data-slot="hero-title">
                    <x-ui.heading level="h1" size="2xl" class="tracking-tight">
                        Muhammad <span class="text-amber-600 dark:text-amber-400">Rizkiansyah</span>
                    </x-ui.heading>
                    <p class="mt-3 text-lg font-medium text-amber-700 dark:text-amber-400">
                        Backend Developer — Laravel & TALL Stack
                    </p>
                </div>

                <p class="text-base leading-relaxed text-neutral-600 dark:text-neutral-400">
                    Saya membangun aplikasi web yang cepat, rapi, dan mudah dipelihara dengan
                    <strong class="font-semibold text-neutral-800 dark:text-neutral-200">Laravel</strong> —
                    mulai dari REST API, admin panel dengan Filament, hingga antarmuka reaktif
                    berbasis Livewire dan Alpine.js. Tulis sekali, jalan terus.
                </p>

                <div class="flex flex-wrap items-center gap-3 pt-1">
                    <a href="#proyek">
                        <x-ui.button color="amber" size="lg" icon-after="arrow-down">
                            Lihat Karya
                        </x-ui.button>
                    </a>
                    <a href="{{ route('posts.index') }}" wire:navigate>
                        <x-ui.button variant="outline" size="lg" color="amber">
                            Baca Artikel
                        </x-ui.button>
                    </a>
                    <a href="#kontak">
                        <x-ui.button variant="ghost" size="lg">
                            Hubungi Saya
                        </x-ui.button>
                    </a>
                </div>

                <div class="pointer-events-auto flex flex-wrap items-center gap-2 pt-2">
                    <span class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Stack favorit:</span>
                    <div class="flex flex-wrap gap-1.5">
                        @foreach ($skills as $skill)
                            <x-ui.badge variant="outline" size="sm">{{ $skill }}</x-ui.badge>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mx-auto shrink-0 md:mx-0 relative">
                <div class="absolute inset-0 -m-4 rounded-full bg-amber-300/20 blur-md dark:bg-amber-500/10"></div>
                <x-ui.avatar
                    name="Muhammad Rizkiansyah"
                    color="amber"
                    size="xl"
                    circle
                    class="!size-28 md:!size-36 relative !text-3xl"
                    alt="Foto Muhammad Rizkiansyah"
                />
            </div>
        </div>
    </section>

    {{-- ================================================= KARYA ================================================== --}}
    <section id="proyek" class="scroll-mt-20 mx-auto max-w-5xl px-4 py-14 md:px-6">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div class="space-y-2">
                <x-ui.badge variant="outline" color="amber" icon="code-bracket" size="sm">Karya</x-ui.badge>
                <x-ui.heading size="xl">Proyek &amp; Produk yang Pernah Saya Bangun</x-ui.heading>
            </div>
            <x-ui.link href="https://github.com/muhrizki" target="_blank" open-in-new-tab class="text-sm">
                Lebih banyak di GitHub
            </x-ui.link>
        </div>

        @if ($projects->isEmpty())
            <x-ui.empty class="py-16">
                <x-ui.icon name="squares-plus" class="size-10 text-amber-500" />
                <x-ui.heading size="md" class="mt-3">Belum ada karya</x-ui.heading>
                <x-ui.text class="mt-1 text-neutral-500 dark:text-neutral-400">
                    Proyek akan ditampilkan di sini setelah ditambahkan lewat panel admin.
                </x-ui.text>
            </x-ui.empty>
        @else
            <div class="mt-8 grid gap-6 sm:grid-cols-2">
                @foreach ($projects as $project)
                    <article class="group flex flex-col overflow-hidden rounded-xl border border-black/10 bg-white shadow-xs transition duration-200 hover:-translate-y-0.5 hover:shadow-lg dark:border-white/10 dark:bg-neutral-900">
                        @if ($project->image)
                            <img
                                src="{{ \Illuminate\Support\Facades\Storage::url($project->image) }}"
                                alt="Tangkapan layar proyek {{ $project->title }}"
                                class="aspect-video w-full border-b border-black/5 object-cover transition duration-300 group-hover:scale-[1.02] dark:border-white/5"
                            />
                        @endif

                        <div class="flex flex-1 flex-col p-5">
                            <div class="flex items-start justify-between gap-3">
                                <x-ui.heading size="md">{{ $project->title }}</x-ui.heading>
                                @if ($project->featured)
                                    <x-ui.badge color="amber" size="sm" icon="star" class="shrink-0">Unggulan</x-ui.badge>
                                @endif
                            </div>

                            <p class="mt-2 line-clamp-3 text-sm leading-relaxed text-neutral-500 dark:text-neutral-400">
                                {{ $project->description }}
                            </p>

                            @if (filled($project->tags))
                                <div class="mt-4 flex flex-wrap gap-1.5">
                                    @foreach ($project->tags as $tag)
                                        <x-ui.badge variant="outline" size="sm" class="text-neutral-500 dark:text-neutral-400">{{ $tag }}</x-ui.badge>
                                    @endforeach
                                </div>
                            @endif

                            <div class="mt-5 border-t border-black/5 pt-4 dark:border-white/5">
                                @if ($link = $projectUrl($project))
                                    <x-ui.link href="{{ $link }}" open-in-new-tab icon-after="arrow-top-right-on-square" class="text-sm">
                                        Buka Proyek
                                    </x-ui.link>
                                @else
                                    <span class="text-sm text-neutral-400 dark:text-neutral-500">Repo privat / belum diunggah</span>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

    {{-- ============================================== PENGALAMAN ================================================ --}}
    <section id="pengalaman" class="scroll-mt-20 bg-white/50 py-14 dark:bg-white/[0.02]">
        <div class="mx-auto max-w-5xl px-4 md:px-6">
            <div class="space-y-2">
                <x-ui.badge variant="outline" color="amber" icon="briefcase" size="sm">Perjalanan</x-ui.badge>
                <x-ui.heading size="xl">Pengalaman &amp; Pendidikan</x-ui.heading>
            </div>

            <div class="mt-8 grid gap-12 md:grid-cols-2">
                {{-- Pengalaman --}}
                <div>
                    <x-ui.heading size="lg">Pengalaman Kerja</x-ui.heading>

                    @if ($experiences->isEmpty())
                        <x-ui.empty class="mt-6">
                            <x-ui.icon name="briefcase" class="size-8 text-amber-500" />
                            <x-ui.text class="mt-2 text-neutral-500">Belum ada riwayat pekerjaan.</x-ui.text>
                        </x-ui.empty>
                    @else
                        <div class="ml-1 mt-6 space-y-9 border-l border-amber-200/70 dark:border-white/10">
                            @foreach ($experiences as $experience)
                                <div class="relative pl-8">
                                    <span class="absolute -left-[7px] top-6 size-3.5 rounded-full border-2 border-amber-400 bg-[#FAF7F2] dark:border-amber-400 dark:bg-neutral-950"></span>

                                    <div class="flex items-center gap-3">
                                        <x-ui.avatar color="amber" icon="briefcase" size="lg" alt="" />
                                        <div class="min-w-0">
                                            <x-ui.heading size="sm">{{ $experience->title }}</x-ui.heading>
                                            <p class="truncate text-sm text-amber-700 dark:text-amber-400">
                                                {{ $experience->company }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-2 flex flex-wrap items-center gap-2 text-xs text-neutral-500 dark:text-neutral-400">
                                        <span class="inline-flex items-center gap-1.5">
                                            <x-ui.icon name="calendar" variant="micro" class="size-3.5" />
                                            {{ $period($experience) }}
                                        </span>
                                        @if ($experience->employment_type)
                                            <span>&middot;</span>
                                            <x-ui.badge variant="outline" size="sm">{{ $experience->employment_type }}</x-ui.badge>
                                        @endif
                                    </div>

                                    @if ($experience->description)
                                        <p class="mt-2 text-sm leading-relaxed text-neutral-600 dark:text-neutral-400">
                                            {{ $experience->description }}
                                        </p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Pendidikan --}}
                <div>
                    <x-ui.heading size="lg">Pendidikan</x-ui.heading>

                    @if ($educations->isEmpty())
                        <x-ui.empty class="mt-6">
                            <x-ui.icon name="academic-cap" class="size-8 text-amber-500" />
                            <x-ui.text class="mt-2 text-neutral-500">Belum ada riwayat pendidikan.</x-ui.text>
                        </x-ui.empty>
                    @else
                        <div class="ml-1 mt-6 space-y-9 border-l border-amber-200/70 dark:border-white/10">
                            @foreach ($educations as $education)
                                <div class="relative pl-8">
                                    <span class="absolute -left-[7px] top-6 size-3.5 rounded-full border-2 border-amber-400 bg-[#FAF7F2] dark:border-amber-400 dark:bg-neutral-950"></span>

                                    <div class="flex items-center gap-3">
                                        <x-ui.avatar color="amber" icon="academic-cap" size="lg" alt="" />
                                        <div class="min-w-0">
                                            <x-ui.heading size="sm">{{ $education->degree }}</x-ui.heading>
                                            <p class="truncate text-sm text-amber-700 dark:text-amber-400">
                                                {{ $education->institution }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-2 flex flex-wrap items-center gap-2 text-xs text-neutral-500 dark:text-neutral-400">
                                        <span class="inline-flex items-center gap-1.5">
                                            <x-ui.icon name="calendar" variant="micro" class="size-3.5" />
                                            {{ $period($education) }}
                                        </span>
                                        @filled($education->field_of_study)
                                            <span>&middot;</span>
                                            <x-ui.badge variant="outline" size="sm">{{ $education->field_of_study }}</x-ui.badge>
                                        @endfilled
                                    </div>

                                    @if ($education->description)
                                        <p class="mt-2 text-sm leading-relaxed text-neutral-600 dark:text-neutral-400">
                                            {{ $education->description }}
                                        </p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- ================================================ ARTIKEL ================================================= --}}
    <section id="artikel" class="scroll-mt-20 mx-auto max-w-5xl px-4 py-14 md:px-6">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div class="space-y-2">
                <x-ui.badge variant="outline" color="amber" icon="pencil-square" size="sm">Menulis</x-ui.badge>
                <x-ui.heading size="xl">Artikel Terbaru</x-ui.heading>
            </div>
            <x-ui.link href="{{ route('posts.index') }}" wire:navigate class="text-sm">
                Lihat semua artikel
            </x-ui.link>
        </div>

        @if ($latestPosts->isEmpty())
            <x-ui.empty class="py-16">
                <x-ui.icon name="newspaper" class="size-10 text-amber-500" />
                <x-ui.heading size="md" class="mt-3">Belum ada artikel</x-ui.heading>
                <x-ui.text class="mt-1 text-neutral-500 dark:text-neutral-400">
                    Tulisan terbaru akan muncul di sini.
                </x-ui.text>
            </x-ui.empty>
        @else
            <div class="mt-8 grid gap-5 md:grid-cols-3">
                @foreach ($latestPosts as $post)
                    <article class="group flex flex-col rounded-xl border border-black/10 bg-white p-5 shadow-xs transition duration-200 hover:-translate-y-0.5 hover:shadow-lg dark:border-white/10 dark:bg-neutral-900">
                        <div class="flex items-center gap-2 text-xs text-neutral-500 dark:text-neutral-400">
                            <x-ui.icon name="calendar" variant="micro" class="size-3.5" />
                            {{ $fmt($post->created_at) }}
                            @if ($post->author)
                                <span>&middot;</span>
                                <span>{{ $post->author->name }}</span>
                            @endif
                        </div>

                        <x-ui.heading size="md" class="mt-3 leading-snug">
                            <a href="{{ route('posts.show', $post) }}" wire:navigate class="transition-colors group-hover:text-amber-700 dark:group-hover:text-amber-400">
                                {{ $post->title }}
                            </a>
                        </x-ui.heading>

                        <p class="mt-2 line-clamp-2 text-sm font-normal text-neutral-500 dark:text-neutral-400">
                            {{ Str::limit(strip_tags($post->content), 110) }}
                        </p>

                        <div class="mt-auto pt-4">
                            <x-ui.link href="{{ route('posts.show', $post) }}" wire:navigate icon-after="arrow-long-right" class="text-sm">
                                Baca selengkapnya
                            </x-ui.link>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

    {{-- ================================================= KONTAK ================================================== --}}
    <section id="kontak" class="scroll-mt-20 bg-white/50 py-14 dark:bg-white/[0.02]">
        <div class="mx-auto grid max-w-5xl items-start gap-10 px-4 md:grid-cols-2 md:px-6">
            <div class="space-y-4">
                <div class="space-y-2">
                    <x-ui.badge variant="outline" color="amber" icon="chat-bubble-left-ellipsis" size="sm">Kontak</x-ui.badge>
                    <x-ui.heading size="xl">Mari Bekerja Sama!</x-ui.heading>
                </div>

                <p class="max-w-md text-base leading-relaxed text-neutral-600 dark:text-neutral-400">
                    Punya proyek, ide produk, atau sekadar ingin berdiskusi soal Laravel?
                    Kirim pesan lewat form di samping atau hubungi saya lewat kanal berikut —
                    biasanya saya menjawab dalam waktu kurang dari satu hari.
                </p>

                <div class="space-y-3 pt-2">
                    <a href="mailto:admin@muhrizki.my.id" class="flex items-center gap-3 text-neutral-700 transition-colors hover:text-amber-700 dark:text-neutral-300 dark:hover:text-amber-400">
                        <x-ui.avatar color="amber" icon="envelope" size="md" alt="" />
                        <span class="text-sm font-medium">admin@muhrizki.my.id</span>
                    </a>
                    <div class="flex items-center gap-3 text-neutral-700 dark:text-neutral-300">
                        <x-ui.avatar color="amber" icon="map-pin" size="md" alt="" />
                        <span class="text-sm font-medium">Jakarta, Indonesia</span>
                    </div>
                </div>

                <div class="flex items-center gap-2 pt-2">
                    @foreach ($socials as $social)
                        <x-ui.tooltip variant="button">
                            <x-slot:trigger>
                                <x-ui.button variant="outline" color="amber" :icon="$social['icon']" :aria-label="$social['label']" />
                            </x-slot:trigger>
                            <x-ui.tooltip.content>{{ $social['label'] }}</x-ui.tooltip.content>
                        </x-ui.tooltip>
                    @endforeach
                </div>
            </div>

            <div class="rounded-xl border border-black/10 bg-white p-6 shadow-md shadow-amber-900/5 dark:border-white/10 dark:bg-neutral-900">
                <x-ui.heading size="md">Kirim Pesan Langsung</x-ui.heading>
                <div class="mt-5">
                    @livewire('contact-form')
                </div>
            </div>
        </div>
    </section>
@endsection
