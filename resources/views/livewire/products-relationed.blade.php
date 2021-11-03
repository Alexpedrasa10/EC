<div>
    <h3 class="text-gray-800 text-base font-bold">También te puede interesar</h3>
    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
        @foreach ($productRelationed as $item)
        <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
           <a href="/producto/{{$item->slug}}">
                <img class="h-80 w-full" src="{{ Storage::disk('dropbox')->url("{$item->photo->filename}") }}"" alt="{{$item->name}}">
                <div class="px-5 py-3">
                    <a href="/producto/{{$item->slug}}" class="text-gray-700 font-bold uppercase block hover:text-indigo-600">{{$item->name}}</a>
                    @if (is_null($item->sale_price))
                        <span class="text-indigo-600 mt-3 text-1xl font-bold">
                            ${{$item->price}}
                        </span>
                    @else
                        <span class="text-indigo-600 mt-3 text-1xl font-bold">
                            ${{$item->sale_price}}
                            <p class="text-red-500 text-sm line-through inline-block">${{$item->price}}</p>
                        </span>
                    @endif
                </div>
           </a>
        </div>
        @endforeach
    </div>
</div>
