<script module>
    import Layout from '../../Layout.svelte'
</script>

<script>
    import { inertia } from '@inertiajs/svelte'

    let { post } = $props()
</script>

<Layout title={post.title}>
    <article>
        <a href="/posts" use:inertia class="mb-4 block text-sm font-semibold text-amber-600 hover:underline dark:text-amber-400">
            ← Kembali ke Artikel
        </a>

        <div class="rounded-xl bg-white p-5 shadow-md dark:bg-gray-800 md:p-8">
            <header class="border-b border-amber-100 pb-4 dark:border-gray-700">
                <h1 class="text-2xl font-bold md:text-3xl">{post.title}</h1>
                <p class="mt-1 text-sm opacity-60">
                    {post.author?.name} <br /> {post.created_at}
                </p>
            </header>

            {#if post.headline_image}
                <div class="mt-6 flex justify-center">
                    <img
                        src={'/storage/' + post.headline_image}
                        alt={post.title}
                        class="max-w-full rounded-lg"
                    />
                </div>
            {/if}

            <div class="mt-8 space-y-4 leading-relaxed">
                {@html post.content}
            </div>
        </div>
    </article>
</Layout>
