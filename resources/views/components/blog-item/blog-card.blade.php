<a href="{{ $href }}">
    @php
        use Illuminate\Support\Str;
    @endphp
    <div class="flex flex-col gap-3 shadow-lg p-4 rounded-lg border">
        <img src="{{ $img }}" class="rounded-lg shadow-lg object-cover w-full h-52" />
        <div class="text-lg font-bold">{{ $title }}</div>
        <div>            
            {!! Str::limit($content, 50) !!}
        </div>
    </div>
</a>