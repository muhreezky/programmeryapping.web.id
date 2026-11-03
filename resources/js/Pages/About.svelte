<script module>
    import Layout from '../Layout.svelte'
</script>

<script>
    import { inertia } from '@inertiajs/svelte'
    import { Avatar } from '@/components/ui/avatar'
    import { Card, CardHeader, CardTitle, CardContent, CardFooter } from '@/components/ui/card'

    let { user } = $props()
</script>

<Layout title="Tentang Saya">
    <div class="min-h-screen bg-background py-12 md:py-24">
        <div class="mx-auto max-w-7xl px-4 md:px-6">
            <div class="text-center mb-16">
                <h1 class="text-5xl md:text-6xl font-bold tracking-tight mb-4">
                    Tentang Saya
                </h1>
                <div class="flex items-center justify-center gap-4 mt-6">
                    <Avatar class="w-24 h-24 rounded-full" alt="Muhammad Rizkiansyah" />
                    <div>
                        <p class="text-lg font-medium">Muhammad Rizkiansyah</p>
                        <p class="text-sm opacity-60">Developer & Writer</p>
                    </div>
                </div>
            </div>

            <Card>
                <CardHeader>
                    <CardTitle>Profil Singkat</CardTitle>
                </CardHeader>
                <CardContent>
                    <p class="text-muted-foreground opacity-80">
                        Saya adalah seorang developer dan penulis yang suka membangun
                        aplikasi web modern menggunakan Laravel dan Svelte. Minat saya
                        mencakup web development, penulisan teknis, dan open source.
                    </p>
                </CardContent>
            </Card>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <Card>
                    <CardHeader>
                        <CardTitle>Skill</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-2">
                                <span class="rounded-full bg-primary/10 px-2.5 py-0.5 text-xs font-medium">Laravel</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="rounded-full bg-primary/10 px-2.5 py-0.5 text-xs font-medium">Svelte</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="rounded-full bg-primary/10 px-2.5 py-0.5 text-xs font-medium">Inertia.js</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="rounded-full bg-primary/10 px-2.5 py-0.5 text-xs font-medium">Tailwind CSS</span>
                            </li>
                        </ul>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader>
                        <CardTitle>Tools</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-2">
                                <span class="rounded-full bg-primary/10 px-2.5 py-0.5 text-xs font-medium">Vite</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="rounded-full bg-primary/10 px-2.5 py-0.5 text-xs font-medium">Tailwind</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="rounded-full bg-primary/10 px-2.5 py-0.5 text-xs font-medium">Git</span>
                            </li>
                        </ul>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader>
                        <CardTitle>Interest</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-2">
                                <span class="rounded-full bg-primary/10 px-2.5 py-0.5 text-xs font-medium">Baca Buku</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="rounded-full bg-primary/10 px-2.5 py-0.5 text-xs font-medium">Koding</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="rounded-full bg-primary/10 px-2.5 py-0.5 text-xs font-medium">Tulis</span>
                            </li>
                        </ul>
                    </CardContent>
                </Card>
            </div>
        </div>
    </div>
</Layout>