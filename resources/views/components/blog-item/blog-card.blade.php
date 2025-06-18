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
            {{ date('d M Y', $item->created_at) }}
        </div>
        <hr />
        <div class="text-gray-700"></div>
        <div>
            {!! Str::limit($item->content) !!}
        </div>
    </div>
</a>