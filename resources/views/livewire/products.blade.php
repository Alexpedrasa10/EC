<div class="p-10">
    <h2 class="font-black text-3xl dark:text-white">Todos los productos </h2>

    <div class="grid grid-cols-1 sm:grid-cols-3 md:sm:grid-cols-2 lg:sm:grid-cols-6 gap-6">
        @foreach ($this->getProducts($products) as $item)

        
        <div class="flex bg-white dark:bg-gray-800 rounded-lg shadow-lg py-4">
            <div class="flex-none w-32 sm:w-20 md:w-48 relative">
                <img src="{{$item->url_photos}}" alt="shopping image" class="absolute rounded-lg inset-0 w-full h-full object-cover"/>
            </div>
            
            <form class="flex-auto px-1">
                @if (isset($item->sale))
                    <div class="flex items-end justify-center rounded-xl w-full bg-yellow-400 text-xl font-black text-gray-50">
                        <span class="text-sm">
                            OFERTA!
                        </span>
                    </div>
                @endif
                <div class="flex flex-wrap">
                    <a href="/productos/{{$item->slug}}" class="cursor-pointer hover:text-indigo-600 flex-auto text-xl font-semibold dark:text-gray-50">
                        {{$item->name}}   
                    </a>
                </div>
                <div class="flex flex-wrap">
                    <div class="text-2xl font-black text-indigo-600 dark:text-gray-300">
                        @if (!isset($item->old_price))
                            ${{$item->price}}
                        @else
                            ${{$item->price}}
                            <span class="text-red-500 text-base line-through inline-block">${{$item->old_price}}</span>
                        @endif
                    </div>
                    <div class="w-full flex-none text-sm font-medium text-gray-500 dark:text-gray-300 mt-2">
                        In stock
                    </div>
                </div>
                <div class="flex items-baseline mt-4 mb-6 text-gray-700 dark:text-gray-300">
                    <div class="space-x-2 flex">
                        @if (!empty($item->sizes ))
                            @foreach ($item->sizes as $sizes)
                            <button type="button" wire:click="setProductSizes( {{$item->id}}, '{{$sizes->size}}' )">
                                <label class="text-center">
                                    <input type="radio" class="w-6 h-6 flex items-center justify-center" name="size"/>
                                    {{strtoupper($sizes->size)}}
                                </label>
                            </button>
                            @endforeach
                        @endif
                        
                    </div>
                </div>
                <div class="flex mb-4 text-sm font-medium">
                    <button type="button" 
                        wire:click="addProductToCart({{$item->id}})"
                        class="py-2 px-1 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                            <span class="text-sm">
                                Agregar al carrito
                            </span>
                    </button>
                </div>
            </form>
        </div>
        @endforeach
    </div>
    <div class="my-5 w-full">
        {{$products->links()}}
    </div>
</div>
