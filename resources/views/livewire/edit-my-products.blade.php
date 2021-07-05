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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
            <div class="grid grid-cols-1">
                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Stock {{$this->hasSizes}}</label>
                @if (!$this->hasSizes)
                    @error('stock') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    <input wire:model="stock" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="numer" placeholder="Ingrese stock del producto" />
                @else
                    <input disabled="true" wire:model="stock" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="numer" placeholder="Ingrese stock del producto" />

                    <h1 class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mt-5">Talles: </h1>
                    <p wire:click="viewNewSize" class="text-sm text-gray-500 cursor-pointer">Para agregar otro talle, haga click aquí. {{$this->newSize}}</p>
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
                    </div>
                @endif

            </div>
        </div>

        <div class="grid grid-cols-1 mt-4 mx-7">
            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Categorias</label>
            <select x-cloak id="select">
                @foreach ($properties as $prop)
                    <option id="{{str_replace(" ", "", $prop->name)}}" wire:click="addProperty({{$prop->id}})" value="{{$prop->id}}">{{$prop->name}}</option>
                @endforeach
            </select>

            <select id="selected" style="display: none">
                @if (!empty($categories))
                    @foreach ($categories as $prop)
                        <option value="{{$prop->id}}">{{$prop->name}}</option>
                    @endforeach
                @endif
            </select>
            
            <div x-data="dropdown()" x-init="loadOptions()" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
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
        
    
        <div class="grid grid-cols-1 mt-5 mx-7">
        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">Subir fotos</label>
            <div class='flex items-center justify-center w-full'>
                <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                    <div class='flex flex-col items-center justify-center pt-7'>
                    <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <p class='lowercase text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider'>Select a photo</p>
                    </div>
                <input type='file' class="hidden" />
                </label>
            </div>
        </div>
    
        <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5'>
            <button wire:click="editProduct" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-50 bg-indigo-500 hover:bg-indigo-800">
                {{ is_null($this->product) ? 'Crear producto' : 'Editar producto' }}
            </button>
        </div>
    
    </div>
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

function dropdown() {
    return {
        options: [],
        selected: [],
        show: false,
        open() { this.show = true },
        close() { this.show = false },
        isOpen() { return this.show === true },
        select(index, event = null) {

            let optionsSelected = document.getElementById('select').options;

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

            let optionsSelected = document.getElementById('select').options;

            for (let i = 0; i < optionsSelected.length; i++) {

                if (this.options[index].value == optionsSelected[i].value) {
                    let opt = document.getElementById(optionsSelected[i].id).click();
                }                    
            }

        },
        loadOptions() {

            const options = document.getElementById('select').options, 
                optionsSelected = document.getElementById('selected').options;

            for (let i = 0; i < options.length; i++) {

                this.options.push({
                    value: options[i].value,
                    text: options[i].innerText,
                    selected: options[i].getAttribute('selected') != null ? options[i].getAttribute('selected') : false
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
