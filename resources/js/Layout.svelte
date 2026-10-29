<script>
    import { inertia, page, usePage } from '@inertiajs/svelte'

    let { title = 'Muhammad Rizkiansyah', children } = $props()

    const shared = usePage().props
</script>

<svelte:head>
    <title>{title}</title>
</svelte:head>

<div class="flex min-h-screen flex-col bg-amber-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100">
    <header class="sticky top-0 z-40 w-full border-b border-amber-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-center justify-between px-4 py-3 md:px-6">
            <a href="/" use:inertia class="text-xl font-bold">
                {shared.app.name}
            </a>

            <nav class="hidden gap-4 md:flex">
                <a
                    href="/"
                    use:inertia
                    class="text-sm font-medium opacity-80 transition hover:opacity-100"
                    aria-current={page.url === '/' ? 'page' : undefined}
                >
                    Beranda
                </a>
                <a
                    href="/posts"
                    use:inertia
                    class="text-sm font-medium opacity-80 transition hover:opacity-100"
                    aria-current={page.url.startsWith('/posts') ? 'page' : undefined}
                >
                    Artikel
                </a>
                {#if shared.auth.user}
                    <span class="text-sm font-medium opacity-80">{shared.auth.user.name}</span>
                {:else}
                    <a href="/login" class="text-sm font-medium opacity-80 transition hover:opacity-100">
                        Masuk
                    </a>
                {/if}
            </nav>
        </div>
    </header>

    <main class="mx-auto w-full max-w-5xl flex-1 space-y-12 px-4 py-8 md:px-6">
        {@render children()}
    </main>

    <footer class="border-t border-amber-200 bg-white py-6 dark:border-gray-700 dark:bg-gray-800">
        <div class="mx-auto flex max-w-5xl flex-col items-center justify-between gap-2 px-4 md:flex-row md:px-6">
            <p class="text-sm opacity-70">
                © {new Date().getFullYear()} {shared.app.name} — Dibuat dengan Laravel, Filament, dan Svelte.
            </p>
            <nav class="flex gap-4 text-sm opacity-80">
                <a href="/" use:inertia class="hover:underline">Beranda</a>
                <a href="/posts" use:inertia class="hover:underline">Artikel</a>
                <a href="/#kontak" use:inertia class="hover:underline">Kontak</a>
            </nav>
        </div>
    </footer>
</div>
