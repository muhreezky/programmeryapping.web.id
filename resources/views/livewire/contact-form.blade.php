<div>
    @if($success)
        <div class="bg-green-100 text-green-800 border border-green-400 rounded px-4 py-3 mb-4" role="alert">
            <strong class="font-bold">Sukses!</strong> Pesan terkirim, terima kasih sudah menghubungi saya!
        </div>
    @endif

    @if($error)
        <div class="bg-red-100 text-red-800 border border-red-400 rounded px-4 py-3 mb-4" role="alert">
            <strong class="font-bold">Error!</strong> {{ $error }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="max-w-lg space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
            <input type="text" name="name" wire:model.defer="name"
                class="mt-1 block w-full rounded border border-gray-300 shadow-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-primary-600"
                placeholder="Nama lengkap" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" wire:model.defer="email"
                class="mt-1 block w-full rounded border border-gray-300 shadow-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-primary-600"
                placeholder="contoh@domain.com" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Subjek</label>
            <input type="text" name="subject" wire:model.defer="subject"
                class="mt-1 block w-full rounded border border-gray-300 shadow-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-primary-600"
                placeholder="Perihal pesan Anda">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
            <textarea name="message" wire:model.defer="message"
                class="mt-1 block w-full rounded border border-gray-300 shadow-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-primary-600 resize h-32"
                rows="3" placeholder="Tulis pesan Anda di sini..."></textarea>
        </div>

        <div class="flex justify-content-end">
            <button type="submit"
                class="inline-flex rounded-md bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                <span>Kirim Pesan</span>
            </button>
        </div>
    </form>
</div>