<div>
    <main class="my-8">
        <div class="container mx-auto px-6">
            <div class="md:flex">
                <div class="w-full h-2/3">
                    <img class="w-full rounded-md object-cover max-w-lg mx-auto" 
                    src="{{$product->url_photos}}" alt="{{$product->name}}">
                </div>
                <div class="w-full mt-1 max-w-lg mx-auto md:ml-8 md:mt-0 md:w-1/2">
                    <h3 class="text-gray-900 uppercase font-black text-4xl">{{$product->name}}</h3>
                    @if (is_null($product->sale_price))
                        <span class="text-indigo-600 mt-3 text-3xl font-bold">
                            ${{$product->price}}
                        </span>
                    @else
                        <span class="text-indigo-600 mt-3 text-3xl font-bold">
                            ${{$product->sale_price}}
                            <p class="text-red-500 text-base line-through inline-block">${{$product->price}}</p>
                        </span>
                    @endif
                    
                    <h1 class="my-5 text-base text-gray-500">
                        {{$product->description}}
                    </h1>
                    <hr class="my-3">
                    <div class="mt-2">
                        <label class="text-gray-700 text-sm" for="count">Cantidad:</label>
                        <div class="flex items-center mt-1">
                            <button wire:click="decrement()" class="hover:text-black text-gray-500 focus:outline-none focus:text-gray-600">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </button>
                            <span class="text-gray-700 text-lg mx-2">{{$current_quantity}}</span>
                            <button wire:click="increment()" class="hover:text-black text-gray-500 focus:outline-none focus:text-gray-600">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </button>
                        </div>
                    </div>
                    @if (isset(json_decode($product->data)->sizes))
                    <div class="flex items-baseline mt-4 mb-6 text-gray-700 dark:text-gray-300">
                        <div class="space-x-2 flex">
                            @foreach (json_decode($product->data)->sizes as $sizes)
                                @if ($sizes->quantity > 0)
                                <button wire:click="setSize('{{$sizes->size}}')" type="button">
                                    <label class="text-center text-gray-500 focus:text-gray-600">
                                        <input type="radio" class="w-6 h-6 flex items-center justify-center" name="size"/>
                                        {{strtoupper($sizes->size)}}
                                    </label>
                                </button>
                                @endif
                            @endforeach                            
                        </div>
                        <a href="#" class="ml-auto hidden md:block text-sm text-gray-500 dark:text-gray-300 underline">
                            Size Guide
                        </a>
                    </div>
                    @endif
                    <div class="flex mt-6">
                        <button wire:click="addToCart" class="px-8 py-2 w-full mx-1 items-center flex bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700 shadow-sm">
                            <span class="px-2">
                                <svg class="h-4 w-4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </span>
                            Agregar al carrito
                        </button>
                        <button wire:click="pay" class="px-8 py-2 w-full mx-1 text-center items-center flex bg-gray-100 text-black text-sm font-medium rounded hover:bg-gray-300 focus:outline-none focus:bg-gray-300 shadow-sm">
                            <span class="px-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                  </svg>
                            </span>
                            Comprar
                        </button>
                    </div>
                    @if ($cartProduct)
                        <div class="my-5">
                            <a href="/cart" class="text-sm text-gray-600 hover:text-indigo-600">Ya tienes este producto en el carrito! Para verlo, apreta aquí.</a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="mt-16">
                <h3 class="text-gray-600 text-2xl font-medium">Productos relacionados</h3>
                <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                    @foreach (json_decode(json_encode($this->productsRelations)) as $item)
                        <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                            <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('{{$item->url_photos}}')">
                            </div>
                        <div class="px-5 py-3">
                            <a href="/producto/{{$item->slug}}" class="text-gray-700 font-bold uppercase block">{{$item->name}}</a>
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
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</div>