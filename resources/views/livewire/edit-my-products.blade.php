<div class="flex bg-gray-200 items-center justify-center p-10">
    <div class="bg-gray-50 rounded-lg shadow-xl p-10 w-full px-5">

        <div class="flex justify-center py-5">
            <x-jet-application-mark class="h-14 inline-block" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
            <div class="grid grid-cols-1">
                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Nombre</label>
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                <input wire:model="name" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" placeholder="Ingrese nombre de producto" />
            </div>
            <div class="grid grid-cols-1">
                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Nombre URL</label>
                <input wire:model="URL" disabled class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" placeholder="Input 2" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
            <div class="grid grid-cols-1">
                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Precio</label>
                @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                <input wire:model="price" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="numer" placeholder="Ingrese precio del producto" />
            </div>
            <div class="grid grid-cols-1">
                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Precio en oferta</label>
                <span class="text-gray-600 text-xs">(Si no quiere que este producto esté en oferta, dejar este campo vacío)</span>
                @error('salePrice') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                <input wire:model="salePrice" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="numer" placeholder="Ingrese precio en OFERTA del producto" />
            </div>
        </div>

        <div class="grid grid-cols-1 mt-5 mx-7">
            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Descripción</label>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <textarea wire:model="description" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="textarea" placeholder="Ingresar descripción"></textarea>
        </div>

        <div class="grid grid-cols-1 mt-4 mx-7">
            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Productos relacionados</label>
            <select x-cloak id="selectProducts">
                @foreach ($products as $prod)
                    <option id="{{$prod->id}}" wire:click="addProduct({{$prod->id}})" value="{{$prod->id}}">{{$prod->name}}</option>
                @endforeach
            </select>

            <select id="selectedProducts" style="display: none">
                @if (!empty($productsRelationed))
                    @foreach (json_decode(json_encode($productsRelationed)) as $prod)
                        <option value="{{$prod->id}}">{{$prod->name}}</option>
                    @endforeach
                @endif
            </select>
            
            <div x-data="dropdownProducts()" x-init="loadOptions()" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
                <input name="values" type="hidden" x-bind:value="selectedValues()">
                <div class="inline-block relative w-full">
                    <div class="flex flex-col items-center relative">
                        <div x-on:click="open" class="w-full">
                            <div class="my-2 p-1 flex border border-gray-50 bg-white rounded">
                                <div class="flex flex-auto flex-wrap">
                                    <template x-for="(option,index) in selected" :key="options[option].value">
                                        <div class="flex justify-center items-center m-1 font-medium py-1 px-1 bg-white rounded border">
                                            <div class="text-xs font-normal leading-none max-w-full flex-initial x-model=" options[option] x-text="options[option].text"></div>
                                            <div class="flex flex-auto flex-row-reverse">
                                                <div x-on:click.stop="remove(index,option)">
                                                    <svg class="fill-current h-4 w-4 " role="button" viewBox="0 0 20 20">
                                                    <path d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0
                                                            c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183
                                                            l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15
                                                            C14.817,13.62,14.817,14.38,14.348,14.849z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    <div x-show="selected.length == 0" class="flex-1">
                                        <input  x-bind:value="selectedValues()">
                                    </div>
                                </div>
                                <div class="text-gray-200 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200 svelte-1l8159u">
                        
                                    <button type="button" x-show="isOpen() === true" x-on:click="open" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                        <svg version="1.1" class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                            <path d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0s0.271,0.701,0,0.969l-7.908,7.83
                                                c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25
                                                L17.418,6.109z" />
                                        </svg>                                    </button>
                                    <button type="button" x-show="isOpen() === false" @click="close" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                        <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                            <path d="M2.582,13.891c-0.272,0.268-0.709,0.268-0.979,0s-0.271-0.701,0-0.969l7.908-7.83
                                                c0.27-0.268,0.707-0.268,0.979,0l7.908,7.83c0.27,0.268,0.27,0.701,0,0.969c-0.271,0.268-0.709,0.268-0.978,0L10,6.75L2.582,13.891z
                                                " />
                                        </svg>
                                    </button>

                                </div>
                        </div>
                    </div>
                    <div class="w-full px-4">
                        <div x-show.transition.origin.top="isOpen()" class="absolute shadow top-100 bg-white z-40 w-full left-0 rounded max-h-select" x-on:click.away="close">
                            <div class="flex flex-col w-full overflow-y-auto h-64">
                                <template x-for="(option,index) in options" :key="option" class="overflow-auto">
                                    <div class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-gray-100" @click="select(index,$event)">
                                        <div class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative">
                                            <div class="w-full items-center flex justify-between">
                                                <div class="mx-2 leading-6" x-model="option" x-text="option.text"></div>
                                                    <div x-show="option.selected">
                                                        <svg class="svg-icon" viewBox="0 0 20 20">
                                                            <path fill="none" d="M7.197,16.963H7.195c-0.204,0-0.399-0.083-0.544-0.227l-6.039-6.082c-0.3-0.302-0.297-0.788,0.003-1.087
                                                                C0.919,9.266,1.404,9.269,1.702,9.57l5.495,5.536L18.221,4.083c0.301-0.301,0.787-0.301,1.087,0c0.301,0.3,0.301,0.787,0,1.087
                                                                L7.741,16.738C7.596,16.882,7.401,16.963,7.197,16.963z"></path>
                                                        </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
            <div class="grid grid-cols-1">
                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Stock {{$this->hasSizes}}</label>
                <span wire:click="hasSizes()" class="text-xs text-gray-500 cursor-pointer">
                    {{ $this->hasSizes ? 'Haz click aquí para eliminar los talles' : 'Haz click aquí para agregar talles'}}
                </span>
                @if (!$this->hasSizes)
                    @error('stock') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    <input wire:model="stock" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="numer" placeholder="Ingrese stock del producto" />
                @else
                    <input disabled="true" wire:model="stock" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="numer" placeholder="Ingrese stock del producto" />

                    <h1 class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mt-5">Talles: </h1>
                    <p wire:click="viewNewSize" class="text-sm text-gray-500 cursor-pointer">Para agregar otro talle, haga click aquí.</p>
                    @if ($this->newSize)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-5 mt-5 bg-gray-50 rounded-md shadow-md p-10">
                                <div class="grid col-span-full md:col-span-1 lg:col-span-1">
                                    <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Talle</label>
                                    <input wire:model="size" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" maxlength="5" placeholder="Ingrese talle" />
                                </div>
                                <div class="grid col-span-full md:col-span-1 lg:col-span-1">
                                    <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Cantidad</label>
                                    <input wire:model="qSize" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="numer" placeholder="Ingrese cantidad" />
                                </div>
                                <div class="grid col-span-full">
                                    <button wire:click="addSize" class="flex items-center justify-center px-4 py-2 border border-indigo-50 rounded-md shadow-sm text-sm font-medium text-purple-600 bg-white hover:bg-indigo-50">Agregar talle</button>
                                </div>
                            </div>
                    @endif
                    <div class="grid grid-cols-2 md:grid-cols-8 gap-10 md:gap-20 lg:gap-20 my-5">
                        @if (!empty($this->sizes))
                            @foreach ( json_decode(json_encode($this->sizes)) as $size)
                                <div class="flex items-center py-2">
                                    <button wire:click="decrementSize('{{$size->size}}')" class="hover:text-black text-gray-500 focus:outline-none focus:text-gray-600" title="Quitar">
                                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </button>
                                    <span style="display: block ruby" class="text-center text-gray-600 text-sm px-2">{{$size->quantity}} en {{$size->size}}</span>
                                    <button wire:click="incrementSize('{{$size->size}}')" class="hover:text-black text-gray-500 focus:outline-none focus:text-gray-600" title="Agregar">
                                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </button>
                                </div>
                                <br>
                            @endforeach 
                        @endif 
                    </div>
                @endif

            </div>
        </div>

        <div class="grid grid-cols-1 mt-4 mx-7">
            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Categorias</label>
            <select x-cloak id="selectProperties">
                @foreach ($properties as $prop)
                    <option id="{{str_replace(" ", "", $prop->name)}}" wire:click="addProperty({{$prop->id}})" value="{{$prop->id}}">{{$prop->name}}</option>
                @endforeach
            </select>

            <select id="selectedProperties" style="display: none">
                @if (!empty($categories))
                    @foreach ($categories as $prop)
                        @if (gettype($prop) != 'array')
                            <option value="{{$prop->id}}">{{$prop->name}}</option>
                        @else 
                            <option value="{{$prop['id']}}">{{$prop['name']}}</option>
                        @endif
                    @endforeach
                @endif
            </select>
            
            <div x-data="dropdownProperties()" x-init="loadOptions()" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
                <input name="values" type="hidden" x-bind:value="selectedValues()">
                <div class="inline-block relative w-full">
                    <div class="flex flex-col items-center relative">
                        <div x-on:click="open" class="w-full">
                            <div class="my-2 p-1 flex border border-gray-50 bg-white rounded">
                                <div class="flex flex-auto flex-wrap">
                                    <template x-for="(option,index) in selected" :key="options[option].value">
                                        <div class="flex justify-center items-center m-1 font-medium py-1 px-1 bg-white rounded border">
                                            <div class="text-xs font-normal leading-none max-w-full flex-initial x-model=" options[option] x-text="options[option].text"></div>
                                            <div class="flex flex-auto flex-row-reverse">
                                                <div x-on:click.stop="remove(index,option)">
                                                    <svg class="fill-current h-4 w-4 " role="button" viewBox="0 0 20 20">
                                                    <path d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0
                                                            c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183
                                                            l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15
                                                            C14.817,13.62,14.817,14.38,14.348,14.849z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    <div x-show="selected.length == 0" class="flex-1">
                                        <input  x-bind:value="selectedValues()">
                                    </div>
                                </div>
                                <div class="text-gray-200 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200 svelte-1l8159u">
                        
                                    <button type="button" x-show="isOpen() === true" x-on:click="open" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                        <svg version="1.1" class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                            <path d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0s0.271,0.701,0,0.969l-7.908,7.83
                                                c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25
                                                L17.418,6.109z" />
                                        </svg>                                    </button>
                                    <button type="button" x-show="isOpen() === false" @click="close" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                        <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                            <path d="M2.582,13.891c-0.272,0.268-0.709,0.268-0.979,0s-0.271-0.701,0-0.969l7.908-7.83
                                                c0.27-0.268,0.707-0.268,0.979,0l7.908,7.83c0.27,0.268,0.27,0.701,0,0.969c-0.271,0.268-0.709,0.268-0.978,0L10,6.75L2.582,13.891z
                                                " />
                                        </svg>
                                    </button>

                                </div>
                        </div>
                    </div>
                    <div class="w-full px-4">
                        <div x-show.transition.origin.top="isOpen()" class="absolute shadow top-100 bg-white z-40 w-full left-0 rounded max-h-select" x-on:click.away="close">
                            <div class="flex flex-col w-full overflow-y-auto h-64">
                                <template x-for="(option,index) in options" :key="option" class="overflow-auto">
                                    <div class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-gray-100" @click="select(index,$event)">
                                        <div class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative">
                                            <div class="w-full items-center flex justify-between">
                                                <div class="mx-2 leading-6" x-model="option" x-text="option.text"></div>
                                                    <div x-show="option.selected">
                                                        <svg class="svg-icon" viewBox="0 0 20 20">
                                                            <path fill="none" d="M7.197,16.963H7.195c-0.204,0-0.399-0.083-0.544-0.227l-6.039-6.082c-0.3-0.302-0.297-0.788,0.003-1.087
                                                                C0.919,9.266,1.404,9.269,1.702,9.57l5.495,5.536L18.221,4.083c0.301-0.301,0.787-0.301,1.087,0c0.301,0.3,0.301,0.787,0,1.087
                                                                L7.741,16.738C7.596,16.882,7.401,16.963,7.197,16.963z"></path>
                                                        </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($product && $product->photos)
        <div class="grid grid-cols-1 mt-5 mx-7">
            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">Fotos</label>
            <div class="my-10 flex">
                @foreach ($product->photos as $item)
                    <div class="px-5">
                        <div class="inline-flex px-5">
                            @if ($item->id == $coverPhoto)
                                <a class="text-yellow-500 cursor-pointer" title="Portada">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </a>
                            @else 
                                <a class="text-gray-400 cursor-pointer" 
                                    wire:click="setCoverPhoto('{{$item->id}}')"
                                    title="Haz click para elegir esta foto como portada">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </a>
                            @endif
                            <a class="text-blue-500 hover:blue-red-700 cursor-pointer" 
                                wire:click="download('{{$item->filename}}')"
                                title="Descargar foto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a class="text-red-500 hover:blue-red-700 cursor-pointer" 
                                wire:click="confirmDetelePhoto({{$item}})"
                                title="Eliminar foto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                        <img class="w-40 px-2" src="{{ Storage::disk('dropbox')->url("$item->filename") }}"/>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
        
    
        <div class="grid grid-cols-1 mt-5 mx-7">
            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">Subir fotos</label>
                @if (!empty($photos))
                    <div class="grid grid-cols-6 mt-5 p-2">
                        @foreach ($photos as $photo)
                            <img class="w-40" src="{{ $photo->temporaryUrl() }}">
                        @endforeach
                    </div>

                @endif
            <div class='flex items-center justify-center w-full'>
                <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                    <div class='flex flex-col items-center justify-center pt-7'>
                    <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <p class='lowercase text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider'>Agregar fotos</p>
                    </div>
                    <input type='file' class="hidden" wire:model="photos" multiple />
                </label>
            </div>
        </div>
    
        <div class='flex items-center justify-center  md:gap-8 gap-4 pt-9 pb-5'>
            <button wire:click="editProduct" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-50 bg-indigo-500 hover:bg-indigo-800">
                {{ is_null($this->product) ? 'Crear producto' : 'Editar producto' }}
            </button>
        </div>

        @if ($this->product)
            <div class="py-5 px-3">
                <a href="{{ route('producto', ['slug' => "{$this->product->slug}"]) }}" class="text-sm font-medium hover:text-indigo-700">Ver Producto</a>
            </div>
        @endif
    </div>

      <!--Modal para confirmar la eliminación de una foto-->
    @if ($confirmDetelePhoto)
    <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                    Eliminar foto
                    </h3>
                    <div class="mt-2">
                    <p class="text-sm text-gray-500">
                        Estas a punto de eliminar esta foto, esto es IRREVERSIBLE. ¿Estás seguro de eliminar?
                    </p>
                    </div>
                </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <a wire:click="destroy" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm cursor-pointer">
                Si
                </a>
                <a wire:click="cancel" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm cursor-pointer">
                Cancelar
                </a>
            </div>
            </div>
        </div>
        </div>
    
    </div>
    @endif
    
</div>


<style>
    [x-cloak] {
    display: none;
    }

    .svg-icon {
    width: 1em;
    height: 1em;
    }

    .svg-icon path,
    .svg-icon polygon,
    .svg-icon rect {
    fill: #333;
    }

    .svg-icon circle {
    stroke: #4691f6;
    stroke-width: 1;
    }
</style>

<script>

function dropdownProperties() {
    return {
        options: [],
        selected: [],
        show: false,
        open() { this.show = true },
        close() { this.show = false },
        isOpen() { return this.show === true },
        select(index, event = null) {

            let optionsSelected = document.getElementById('selectProperties').options;

            if (!this.options[index].selected) {


                this.options[index].selected = true;

                if (event) {
                    this.options[index].element = event.target;
                }
        
                this.selected.push(index);

            } else {
                this.selected.splice(this.selected.lastIndexOf(index), 1);
                this.options[index].selected = false
            }

            // Updatea en componente de livewire
            if (event) {
                for (let i = 0; i < optionsSelected.length; i++) {

                    if (this.options[index].value == optionsSelected[i].value) {
                        let opt = document.getElementById(optionsSelected[i].id).click();
                    }                    
                }
            }
        },
        remove(index, option) {
            this.options[option].selected = false;
            this.selected.splice(index, 1);

            let optionsSelected = document.getElementById('selectProperties').options;

            for (let i = 0; i < optionsSelected.length; i++) {

                if (this.options[index].value == optionsSelected[i].value) {
                    let opt = document.getElementById(optionsSelected[i].id).click();
                }                    
            }

        },
        loadOptions() {

            const options = document.getElementById('selectProperties').options, 
                optionsSelected = document.getElementById('selectedProperties').options;

            for (let i = 0; i < options.length; i++) {

                this.options.push({
                    value: options[i].value,
                    text: options[i].innerText,
                    selected: options[i].getAttribute('selectedProperties') != null ? options[i].getAttribute('selectedProperties') : false
                });

                for (let j = 0; j < optionsSelected.length; j++) {
                    
                    if (options[i].value == optionsSelected[j].value) {

                        let index = this.options.length - 1;
                        this.select(index, null);
                    }
                }
            }
        },
        selectedValues(){
            return this.selected.map((option)=>{
                return this.options[option].value;
            })
        }
    }
}

function dropdownProducts() {
    return {
        options: [],
        selected: [],
        show: false,
        open() { this.show = true },
        close() { this.show = false },
        isOpen() { return this.show === true },
        select(index, event = null) {

            let optionsSelected = document.getElementById('selectProducts').options;

            if (!this.options[index].selected) {

                this.options[index].selected = true;

                if (event) {
                    this.options[index].element = event.target;
                }
        
                this.selected.push(index);

            } else {
                this.selected.splice(this.selected.lastIndexOf(index), 1);
                this.options[index].selected = false
            }

            // Updatea en componente de livewire
            if (event) {
                for (let i = 0; i < optionsSelected.length; i++) {

                    if (this.options[index].value == optionsSelected[i].value) {
                        console.log(optionsSelected[i])
                        let opt = document.getElementById(optionsSelected[i].id).click();
                    }                    
                }
            }
        },
        remove(index, option) {

            this.options[option].selected = false;
            this.selected.splice(index, 1);

            let optionsSelected = document.getElementById('selectProducts').options;

            for (let i = 0; i < optionsSelected.length; i++) {

                if (this.options[option].value == optionsSelected[i].value) {
                    let opt = document.getElementById(optionsSelected[i].id).click();
                    console.log(optionsSelected[i]);
                }                    
            }

        },
        loadOptions() {

            const options = document.getElementById('selectProducts').options, 
                optionsSelected = document.getElementById('selectedProducts').options;

            for (let i = 0; i < options.length; i++) {

                this.options.push({
                    value: options[i].value,
                    text: options[i].innerText,
                    selected: options[i].getAttribute('selectedProducts') != null ? options[i].getAttribute('selectedProducts') : false
                });

                for (let j = 0; j < optionsSelected.length; j++) {
                    
                    if (options[i].value == optionsSelected[j].value) {

                        let index = this.options.length - 1;
                        this.select(index, null);
                    }
                }
            }
        },
        selectedValues(){
            return this.selected.map((option)=>{
                return this.options[option].value;
            })
        }
    }
}
</script>
