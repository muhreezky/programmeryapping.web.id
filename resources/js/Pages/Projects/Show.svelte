<script module>
    import Layout from '../../Layout.svelte'
</script>

<script>
    import { inertia } from '@inertiajs/svelte'
    import { Card, CardHeader, CardTitle, CardContent, CardFooter } from '@/components/ui/card'
    import { Button } from '@/components/ui/button'

    let { post } = $props()
</script>

<Layout title={post.title}>
    <div class="py-12 bg-background">
        <div class="mx-auto max-w-7xl px-4 md:px-6">
            <Card>
                <CardHeader>
                    <CardTitle>{post.title}</CardTitle>
                </CardHeader>
                <CardContent>
                    {#if post.headline_image}
                        <div class="mt-6 flex justify-center">
                            <img src="/storage/{post.headline_image}" alt={post.title} class="max-w-full rounded-lg" />
                        </div>
                    {/if}

                    <div class="mt-8 space-y-4 leading-relaxed">
                        {@html post.content}
                    </div>
                </CardContent>
                {#if post.url}
                    <CardFooter>
                        <a href={post.url} target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-primary underline offset-4 hover:underline-4">
                            Lihat Proyek →
                        </a>
                    </CardFooter>
                {/if}
            </Card>
        </div>
    </div>
</Layout>