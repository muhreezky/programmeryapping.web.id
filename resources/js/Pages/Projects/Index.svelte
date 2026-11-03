<script module>
    import Layout from '../../Layout.svelte'
</script>

<script>
    import { inertia } from '@inertiajs/svelte'
    import { Card, CardHeader, CardTitle, CardContent, CardFooter } from '@/components/ui/card'
    import { Button } from '@/components/ui/button'

    let { projects } = $props()
</script>

<Layout title="Proyek">
    <div class="py-12 bg-background">
        <div class="mx-auto max-w-7xl px-4 md:px-6">
            <div class="mb-8">
                <h1 class="text-4xl md:text-5xl font-bold tracking-tight mb-4">Proyek Terbaru</h1>
                <p class="text-lg text-muted-foreground max-w-2xl">
                    Berikut adalah proyek-proyek yang pernah saya kerjakan
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                {#each projects.data as project (project.id)}
                    <article>
                        <a href="/projects/{project.slug}" use:inertia class="group block rounded-xl bg-card p-6 shadow-sm transition-transform hover:translate-y-1 hover:shadow-md dark:bg-gray-800 dark:hover:shadow-gray-600">
                            {#if project.image}
                                <img src="/storage/{project.image}" alt={project.title} class="rounded-lg h-48 w-full object-cover mb-4 group-hover:opacity-90" />
                            {/if}
                            <div>
                                <h3 class="font-medium text-truncate line-clamp-2">{project.title}</h3>
                                <p class="mt-1 text-sm text-muted-overflow opacity-60">{@html project.description}</p>
                            </div>
                        </a>
                    </article>
                {/each}
            </div>

            {#if projects.currentPage < projects.lastPage}
                <nav class="mt-8 flex flex-wrap items-center justify-center gap-2" aria-label="Pagination">
                    {#each projects.links.slice(1, -1) as link}
                        {#if link.url}
                            <a href="{link.url}" use:inertia class="rounded-lg border border-muted-200 px-3 py-1.5 text-sm shadow-sm dark:border-gray-600 {link.active ? 'bg-muted-100 text-muted-foreground' : 'bg-card dark:bg-gray-800'}">
                                {link.label.replace('&laquo;', '«').replace('&raquo', '»')}
                            </a>
                        {:else}
                            <span class="rounded-lg border border-muted-200 bg-white px-3 py-1.5 text-sm opacity-40 dark:border-gray-600 dark:bg-gray-800">
                                {link.label.replace('&laquo;', '«').replace('&raquo', '»')}
                            </span>
                        {/if}
                    {/each}
                </nav>
            {/if}
        </div>
    </div>
</Layout>