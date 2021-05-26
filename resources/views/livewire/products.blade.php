<div class="p-10">
    <h2 class="font-black text-3xl dark:text-white">Todos los productos </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:sm:grid-cols-2 lg:sm:grid-cols-6 gap-6">
        @foreach ($this->getProducts($products) as $item)

        <div class="flex bg-white dark:bg-gray-800 rounded-lg shadow-lg">
            <div class="flex-none w-32 sm:w-40 md:w-48 relative">
                <img src="{{$item->url_photos}}" alt="shopping image" class="absolute rounded-lg inset-0 w-full h-full object-cover"/>
            </div>
            <form class="flex-auto p-6">
                <div class="flex flex-wrap">
                    <h1 class="flex-auto text-xl font-semibold dark:text-gray-50">
                        {{$item->name}}   
                    </h1>
                    <div class="text-2xl font-black text-blue-600 dark:text-gray-300">
                        ${{$item->price}}
                    </div>
                    <div class="w-full flex-none text-sm font-medium text-gray-500 dark:text-gray-300 mt-2">
                        In stock
                    </div>
                </div>
                <div class="flex items-baseline mt-4 mb-6 text-gray-700 dark:text-gray-300">
                    <div class="space-x-2 flex">
                        @if (!empty($item->sizes ))
                            @foreach ($item->sizes as $value => $sizes)
                            <button type="button" wire:click="setProductSizes( {{$item->id}}, '{{$value}}' )">
                                <label class="text-center">
                                    <input type="radio" class="w-6 h-6 flex items-center justify-center" name="size"/>
                                    {{strtoupper($value)}}
                                </label>
                            </button>
                            @endforeach
                        @endif
                        
                    </div>
                    <a href="#" class="ml-auto hidden md:block text-sm text-gray-500 dark:text-gray-300 underline">
                        Size Guide
                    </a>
                </div>
                <div class="flex mb-4 text-sm font-medium">
                    <button type="button" 
                        wire:click="addProductToCart({{$item->id}})"
                        class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                        Agregar al carrito
                    </button>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-300">
                Free shipping on all continental US orders.
                </p>
            </form>
        </div>
        @endforeach
    </div>
    <div class="my-5 w-full bg-gray-50">
        {{$products->links()}}
    </div>
</div>
