<script module>
    import Layout from '../Layout.svelte'
</script>

<script>
    import { inertia } from '@inertiajs/svelte'
    import ContactSection from '../Components/ContactSection.svelte'

    let { experiences, education, projects, latestPosts } = $props()

    const monthYear = (date) =>
        date ? new Date(date).toLocaleDateString('id-ID', { month: 'short', year: 'numeric' }) : ''
</script>

<Layout title="Beranda">
    <section class="text-center">
        <h1 class="text-4xl font-bold md:text-6xl">Muhammad Rizkiansyah</h1>
        <p class="mt-6 text-xl md:text-2xl">
            Tidak perlu terlalu banyak mengerjakan kode-mu, mampir dan baca <strong>artikel</strong>-ku
            atau lihat <strong>proyek</strong>-ku di sini.
        </p>
        <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
            <a
                href="#proyek"
                use:inertia
                class="rounded-lg bg-amber-500 px-5 py-2.5 font-semibold text-white shadow transition hover:bg-amber-600"
            >
                Lihat Portofolio
            </a>
            <a
                href="/posts"
                use:inertia
                class="rounded-lg border border-amber-500 px-5 py-2.5 font-semibold text-amber-700 transition hover:bg-amber-100 dark:text-amber-300 dark:hover:bg-gray-800"
            >
                Baca Artikel
            </a>
        </div>
    </section>

    <section id="pengalaman">
        <h2 class="text-3xl font-bold">Pengalaman</h2>
        <ol class="mt-6 space-y-8 border-l-2 border-amber-200 pl-6 dark:border-gray-700">
            {#each experiences as exp (exp.id)}
                <li class="relative">
                    <span class="absolute -left-7 top-1.5 h-4 w-4 rounded-full bg-amber-500" aria-hidden="true"></span>
                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1">
                        <h3 class="text-lg font-semibold">{exp.title}</h3>
                        {#if exp.is_current}
                            <span class="rounded-full bg-amber-500 px-2.5 py-0.5 text-xs font-semibold text-white">
                                Sekarang
                            </span>
                        {/if}
                    </div>
                    <p class="text-sm opacity-70">
                        {exp.company}{exp.employment_type ? ` • ${exp.employment_type}` : ''}
                        •
                        {monthYear(exp.started_at)} — {exp.is_current ? 'Sekarang' : monthYear(exp.ended_at)}
                    </p>
                    {#if exp.description}
                        <div class="mt-2 text-sm leading-relaxed opacity-80">{@html exp.description}</div>
                    {/if}
                </li>
            {/each}
        </ol>
    </section>

    <section id="pendidikan">
        <h2 class="text-3xl font-bold">Pendidikan</h2>
        <ol class="mt-6 space-y-8 border-l-2 border-amber-200 pl-6 dark:border-gray-700">
            {#each education as edu (edu.id)}
                <li class="relative">
                    <span class="absolute -left-7 top-1.5 h-4 w-4 rounded-full bg-amber-500" aria-hidden="true"></span>
                    <h3 class="text-lg font-semibold">{edu.institution}</h3>
                    <p class="text-sm opacity-70">
                        {edu.degree}{edu.field_of_study ? ` • ${edu.field_of_study}` : ''}
                    </p>
                    <p class="text-sm opacity-60">
                        {monthYear(edu.started_at)} — {edu.is_current ? 'Sekarang' : monthYear(edu.ended_at)}
                    </p>
                    {#if edu.description}
                        <div class="mt-2 text-sm leading-relaxed opacity-80">{@html edu.description}</div>
                    {/if}
                </li>
            {/each}
        </ol>
    </section>

    <section id="proyek">
        <h2 class="text-3xl font-bold">Proyek</h2>
        <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2">
            {#each projects as project (project.id)}
                <article class="flex flex-col overflow-hidden rounded-xl bg-white shadow-md dark:bg-gray-800">
                    {#if project.image}
                        <img
                            src={'/storage/' + project.image}
                            alt={project.title}
                            class="h-44 w-full object-cover"
                        />
                    {/if}
                    <div class="flex flex-1 flex-col gap-2 p-5">
                        <div class="flex items-center gap-2">
                            <h3 class="text-lg font-bold">{project.title}</h3>
                            {#if project.featured}
                                <span class="rounded-full bg-amber-100 px-2 py-0.5 text-xs font-semibold text-amber-800 dark:bg-amber-900 dark:text-amber-200">
                                    Unggulan
                                </span>
                            {/if}
                        </div>
                        <div class="text-sm leading-relaxed opacity-80">{@html project.description}</div>
                        {#if project.tags}
                            <div class="mt-2 flex flex-wrap gap-2">
                                {#each project.tags as tag}
                                    <span class="rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-semibold text-amber-800 dark:bg-amber-900 dark:text-amber-200">
                                        {tag}
                                    </span>
                                {/each}
                            </div>
                        {/if}
                        {#if project.url}
                            <a
                                href={project.url}
                                target="_blank"
                                rel="noopener noreferrer"
                                class="mt-2 text-sm font-semibold text-amber-600 hover:underline dark:text-amber-400"
                            >
                                Lihat Proyek →
                            </a>
                        {/if}
                    </div>
                </article>
            {/each}
        </div>
    </section>

    <section id="artikel-terbaru">
        <div class="flex items-baseline justify-between">
            <h2 class="text-3xl font-bold">Artikel Terbaru</h2>
            <a
                href="/posts"
                use:inertia
                class="text-sm font-semibold text-amber-600 hover:underline dark:text-amber-400"
            >
                Lihat Semua →
            </a>
        </div>
        <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-3">
            {#each latestPosts as post (post.id)}
                <a
                    href={'/posts/' + post.slug}
                    use:inertia
                    class="block rounded-xl bg-white p-5 shadow-md transition hover:shadow-lg dark:bg-gray-800"
                >
                    <h3 class="font-bold">{post.title}</h3>
                    <p class="mt-1 text-sm opacity-60">
                        {post.author?.name} • {post.created_at}
                    </p>
                </a>
            {/each}
        </div>
    </section>

    <ContactSection />
</Layout>
