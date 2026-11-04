<div class="space-y-5">
    @if ($success)
        <x-ui.alerts success icon="check-circle">
            <x-ui.alerts.heading>Terkirim!</x-ui.alerts.heading>
            <x-ui.alerts.description>
                Pesan berhasil dikirim, terima kasih sudah menghubungi saya. Saya akan segera membalas.
            </x-ui.alerts.description>
        </x-ui.alerts>
    @endif

    @if ($error)
        <x-ui.alerts error icon="exclamation-triangle">
            <x-ui.alerts.heading>Gagal mengirim</x-ui.alerts.heading>
            <x-ui.alerts.description>{{ $error }}</x-ui.alerts.description>
        </x-ui.alerts>
    @endif

    <form wire:submit class="space-y-4">
        <x-ui.field required>
            <x-ui.label>Nama</x-ui.label>
            <x-ui.input
                wire:model="name"
                type="text"
                name="name"
                placeholder="Nama lengkap"
                left-icon="user"
                autocomplete="name"
            />
            <x-ui.error name="name" />
        </x-ui.field>

        <x-ui.field required>
            <x-ui.label>Email</x-ui.label>
            <x-ui.input
                wire:model="email"
                type="email"
                name="email"
                placeholder="contoh@domain.com"
                left-icon="envelope"
                autocomplete="email"
            />
            <x-ui.error name="email" />
        </x-ui.field>

        <x-ui.field required>
            <x-ui.label>Subjek</x-ui.label>
            <x-ui.input
                wire:model="subject"
                type="text"
                name="subject"
                placeholder="Perihal pesan Anda"
            />
            <x-ui.error name="subject" />
        </x-ui.field>

        <x-ui.field required>
            <x-ui.label>Pesan</x-ui.label>
            <x-ui.textarea
                wire:model="message"
                name="message"
                rows="4"
                placeholder="Tulis pesan Anda di sini..."
            />
            <x-ui.error name="message" />
        </x-ui.field>

        <div class="flex justify-end">
            <x-ui.button color="amber" size="lg" type="submit" icon-after="paper-airplane" class="w-full sm:w-auto">
                Kirim Pesan
            </x-ui.button>
        </div>
    </form>
</div>
