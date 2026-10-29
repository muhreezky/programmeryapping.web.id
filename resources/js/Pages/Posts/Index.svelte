<script module>
    import Layout from '../../Layout.svelte'
</script>

<script>
    import { inertia } from '@inertiajs/svelte'

    let { posts } = $props()
</script>

<Layout title="Artikel">
    <section>
        <h1 class="text-3xl font-bold">Artikel</h1>
        <p class="mt-2 opacity-70">Kumpulan artikel yang dapat menambah pengetahuan dan bertukar cerita</p>

        <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            {#each posts.data as post (post.id)}
                <a
                    href={'/posts/' + post.slug}
                    use:inertia
                    class="flex flex-col overflow-hidden rounded-xl bg-white shadow-md transition hover:shadow-lg dark:bg-gray-800"
                >
                    {#if post.headline_image}
                        <img
                            src={'/storage/' + post.headline_image}
                            alt={post.title}
                            class="h-52 w-full object-cover"
                        />
                    {/if}
                    <div class="flex flex-col gap-1 p-4">
                        <h2 class="text-lg font-bold">{post.title}</h2>
                        <p class="text-sm opacity-60">{post.author?.name} • {post.created_at}</p>
                    </div>
                </a>
            {/each}
        </div>

        <nav class="mt-8 flex flex-wrap items-center justify-center gap-2" aria-label="Pagination">
            {#each posts.links.slice(1, -1) as link}
                {#if link.url}
                    <a
                        href={link.url}
                        use:inertia
                        class="rounded-lg border border-amber-200 px-3 py-1.5 text-sm shadow-sm dark:border-gray-600 {link.active
                            ? 'bg-amber-500 text-white'
                            : 'bg-white dark:bg-gray-800'}"
                    >
                        {link.label.replace('&laquo;', '«').replace('&raquo;', '»')}
                    </a>
                {:else}
                    <span
                        class="rounded-lg border border-amber-200 bg-white px-3 py-1.5 text-sm opacity-40 dark:border-gray-600 dark:bg-gray-800"
                    >
                        {link.label.replace('&laquo;', '«').replace('&raquo;', '»')}
                    </span>
                {/if}
            {/each}
        </nav>
    </section>
</Layout>
