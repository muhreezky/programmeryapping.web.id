<div>
    @if($post->count() > 0)
        <div class="space-y-6">
            @foreach($post as $data)
                <div class="p-4 rounded-lg border border-amber-200 dark:border-gray-700 bg-white dark:bg-gray-800 hover:shadow-md transition-shadow">
                    <h3 class="text-lg font-bold text-amber-800 mb-1">{{ $data->title }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 line-clamp-3 mb-2">
                        {{ Str::limit(strip_tags($data->content), 100) }}
                    </p>
                    <div class="text-xs text-gray-500 dark:text-gray-400">
                        <span>{{ $data->created_at->format('M d, Y') }}</span>
                        @if($data->author)
                            <span class="mx-2">|</span>
                            <span>{{ $data->author->name }}</span>
                        @endif
                    </div>
                    <a href="/posts/{{ $data->slug }}"
                        class="text-amber-600 hover:underline text-sm mt-2 block">
                        Baca selengkapnya
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="p-8 text-center text-gray-500 dark:text-gray-400">
            <p>Tidak ada artikel ditemukan</p>
        </div>
    @endif
</div>