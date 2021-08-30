<div class="px-2">
    <h1 class="text-3xl font-bold ">Productos</h1>

    <div class="py-5">
        <div class="w-full flex flex-col mb-3">
            <div>
                <label class=" text-gray-500 py-2">Filtrar por</label>
                <select wire:model="filter" class="block text-grey-darker border border-gray-200 rounded-lg w-full sm:w-1/5 md:w-2/5 " required="required" name="integration[city_id]" id="integration_city_id">
                    <option value="null">Todos</option>
                    <option value="priceLower">Precio más bajo</option>
                    <option value="priceHigher">Precio más alto</option>
                    <option value="sale">En oferta</option>
                </select>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 md:sm:grid-cols-3 lg:sm:grid-cols-6 gap-3 sm:gap-2 md:gap-2 lg:gap-2">
        @foreach ($products as $item)
        <div class="flex bg-white dark:bg-gray-800 rounded-sm shadow-md hover:shadow-lg py-4">
            <div class="flex-none w-48 relative">
                <img src="{{ Storage::disk('dropbox')->url("{$item->photo->filename}") }}" alt="shopping image" class="absolute rounded-lg inset-0 w-full h-full object-cover"/>
            </div>
            
            <form class="flex-auto px-1">
                @if (!is_null($item->sale_price))
                    <div class="flex items-end justify-center rounded-sm p-1 w-full bg-yellow-400 text-xl font-black text-gray-50">
                        <span class="text-sm">
                            OFERTA!
                        </span>
                    </div>
                @endif
                <div class="flex flex-wrap">
                    <a title="Ver más" href="/producto/{{$item->slug}}" class="cursor-pointer hover:text-indigo-600 flex-auto text-xl font-semibold dark:text-gray-50">
                        {{$item->name}}   
                    </a>
                </div>
                <div class="flex flex-wrap">
                    <div class="text-2xl font-black text-indigo-600 dark:text-gray-300">
                        @if (is_null($item->sale_price))
                            ${{$item->price}}
                        @else
                            ${{$item->sale_price}}
                            <span class="text-red-500 text-base line-through inline-block">${{$item->price}}</span>
                        @endif
                    </div>
                    <div class="w-full flex-none text-sm font-medium text-gray-500 dark:text-gray-300 mt-2">
                        In stock
                    </div>
                </div>
                <div class="flex items-baseline mt-4 mb-6 text-gray-700 dark:text-gray-300">
                    <div class="space-x-2 flex">
                        @if (!empty($item->data) && isset(json_decode($item->data)->sizes))
                            @foreach (json_decode($item->data)->sizes as $sizes)
                                @if ($sizes->quantity > 0)
                                    <button type="button" wire:click="setProductSizes( {{$item->id}}, '{{$sizes->size}}' )">
                                        <label class="text-center">
                                            <input type="radio" class="cursor-pointer w-6 h-6 flex items-center justify-center" name="size"/>
                                            {{strtoupper($sizes->size)}}
                                        </label>
                                    </button>
                                @endif
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
