<a href="{{ $href }}">
    @php
        use Illuminate\Support\Str;
        /**
         * @var \App\Models\BlogPost $item
         * */
    @endphp
    <div class="flex flex-col gap-2 p-4">
        <img src="/storage/{{ $item->headline_image }}" class="rounded-lg shadow-lg object-cover w-full h-52" />
        <div class="text-lg font-bold">{{ $item->title }}</div>
        <div class="text-gray-800">
            {{ $item->created_at }}
        </div>
        <hr />
        <div class="text-gray-700"></div>
        <div>
            {!! str(Str::limit($item->content))->sanitizeHtml() !!}
        </div>
    </div>
</a>