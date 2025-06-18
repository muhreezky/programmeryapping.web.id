<x-filament::section class="shadow-lg">
    @php
        /**
         * @var \Illuminate\Pagination\LengthAwarePaginator $blogs
         * */
    @endphp
    <x-slot name="heading">Artikel</x-slot>
    <x-slot name="description">Kumpulan artikel yang dapat menambah pengetahuan dan bertukar cerita</x-slot>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 mb-5">
        @foreach ($blogs->items() as $item)
            <x-blog-item.blog-card 
                :href="route('view-post', [
                    'blog_post' => $item->slug
                ])" img="/storage/{{ $item->headline_image }}" 
                :title="$item->title" 
                :content="$item->content" 
            />
        @endforeach
    </div>
    <x-filament::pagination :paginator="$blogs" ::page-options="[10, 20, 25, 50]" />
</x-filament::section>