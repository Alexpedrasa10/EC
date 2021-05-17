<div class="p-10">
    <h2 class="font-black text-3xl pb-10 dark:text-white">Todos los productos</h2>

    <div class="grid grid-cols-1 sm:grid-cols-3 md:sm:grid-cols-3 lg:sm:grid-cols-6 gap-6">
        @foreach ($products as $item)
            <div class="rounded-sm bg-gray-300 p-5">
                <img src="{{$item->url_photos}}" class="w-23 h-23" alt="">
                <h2 class="text-2xl dark:text-white font-bold">{{$item->name}}</h2>
                <p class="text-base dark:text-white">{{$item->description}}</p>
                <p class="tabular-nums font-bold  dark:text-white text-1xl pt-5">${{$item->price}}</p>
                <button class="bg-yellow-400 uppercase text-white dark:text-white p-3 w-full mt-1" wire:click="addProductToCart({{$item->id}})"> 
                    <span class="font-black">Agregar al carrito </span>
                </button>
            </div>
        @endforeach
    </div>
</div>
