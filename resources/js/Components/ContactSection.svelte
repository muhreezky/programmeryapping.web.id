<script>
    import { useForm, usePage } from '@inertiajs/svelte'

    const shared = usePage().props

    let { flash = null } = $props()

    const form = useForm({
        sender_name: '',
        sender_email: '',
        subject: '',
        content: '',
    })

    function submit(event) {
        event.preventDefault()
        form.post('/contact', {
            onSuccess: () => form.reset(),
        })
    }
</script>

<section id="kontak">
    <h2 class="text-3xl font-bold">Kontak</h2>
    <p class="mt-2 opacity-70">Ada cerita atau kerja sama? Tulis pesanmu di sini, aku akan membalas lewat e-mail.</p>

    <form class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2" onsubmit={submit}>
        <div>
            <label class="mb-1 block text-sm font-semibold" for="sender_name">Nama</label>
            <input
                id="sender_name"
                type="text"
                bind:value={form.sender_name}
                placeholder="Nama Anda"
                maxlength="255"
                class="w-full rounded-lg border border-amber-200 bg-white px-3 py-2 dark:border-gray-600 dark:bg-gray-800"
            />
            {#if form.errors.sender_name}
                <p class="mt-1 text-sm text-red-600">{form.errors.sender_name}</p>
            {/if}
        </div>
        <div>
            <label class="mb-1 block text-sm font-semibold" for="sender_email">E-mail</label>
            <input
                id="sender_email"
                type="email"
                bind:value={form.sender_email}
                placeholder="E-mail aktif Anda"
                maxlength="255"
                class="w-full rounded-lg border border-amber-200 bg-white px-3 py-2 dark:border-gray-600 dark:bg-gray-800"
            />
            {#if form.errors.sender_email}
                <p class="mt-1 text-sm text-red-600">{form.errors.sender_email}</p>
            {/if}
        </div>
        <div class="md:col-span-2">
            <label class="mb-1 block text-sm font-semibold" for="subject">Judul Pesan</label>
            <input
                id="subject"
                type="text"
                bind:value={form.subject}
                placeholder="Tulis Judul Pesan"
                maxlength="255"
                class="w-full rounded-lg border border-amber-200 bg-white px-3 py-2 dark:border-gray-600 dark:bg-gray-800"
            />
            {#if form.errors.subject}
                <p class="mt-1 text-sm text-red-600">{form.errors.subject}</p>
            {/if}
        </div>
        <div class="md:col-span-2">
            <label class="mb-1 block text-sm font-semibold" for="content">Pesan</label>
            <textarea
                id="content"
                rows="4"
                bind:value={form.content}
                placeholder="Pesan Anda untuk saya"
                class="w-full rounded-lg border border-amber-200 bg-white px-3 py-2 dark:border-gray-600 dark:bg-gray-800"
            ></textarea>
            {#if form.errors.content}
                <p class="mt-1 text-sm text-red-600">{form.errors.content}</p>
            {/if}
        </div>
        <div class="flex items-center gap-3 md:col-span-2">
            <button
                type="submit"
                disabled={form.processing}
                class="rounded-lg bg-amber-500 px-5 py-2.5 font-semibold text-white shadow transition hover:bg-amber-600 disabled:opacity-60"
            >
                {form.processing ? 'Mengirim...' : 'Kirim Pesan'}
            </button>
            {#if shared.flash?.success}
                <span class="text-sm font-semibold text-green-700 dark:text-green-400">
                    {shared.flash.success}
                </span>
            {/if}
        </div>
    </form>
</section>
