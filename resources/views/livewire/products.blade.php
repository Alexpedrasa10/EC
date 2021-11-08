<div class="px-2">
    <h1 class="text-3xl font-bold ">Productos</h1>

    <div class="py-5">
        <div class="grid grid-cols-1 sm:grid-cols-4 md:sm:grid-cols-4 lg:sm:grid-cols-4 gap-2 sm:gap-2 md:gap-2 lg:gap-2">
            <div class="col-span-2">
                <label class=" text-gray-500 py-2">Filtrar por</label>
                <select type="search" wire:model="filter" class="block text-grey-darker border border-gray-200 rounded-lg w-full sm:w-1/5 md:w-3/5 " required="required" name="integration[city_id]" id="integration_city_id">
                    <option value="null">Todos</option>
                    <option value="priceLower">Precio más bajo</option>
                    <option value="priceHigher">Precio más alto</option>
                    <option value="sale">En oferta</option>
                </select>
            </div>
            <div class="col-span-2 flex flex-row">
                <div class="flex-1 mx-1">
                    <label class=" text-gray-500 py-2" for="until">Desde</label>
                    <input class="block text-grey-darker border border-gray-200 rounded-lg w-full " wire:model="until" type="number">
                </div>
                <div class="flex-1 mx-1">
                    <label class=" text-gray-500 py-2" for="until">Hasta</label>
                    <input class="block text-grey-darker border border-gray-200 rounded-lg w-full" wire:model="since" type="number">
                </div>
            </div>
            <div class="col-span-full flex flex-row my-2">
                @foreach ($allCategories as $cat)

                <div class="flex-1 mx-1">
                        <label  class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">{{$cat->name}}</label>
                        <select  style="display: none" id="{{$cat->category}}">
                            @foreach ($cat->options as $prop)
                                <option id="{{$prop->code}}" value="{{$prop->code}}" wire:click="addCategory({{$prop}})">{{$prop->name}}</option>
                            @endforeach
                        </select>

                        <select id="{{$cat->category}}Selected" style="display: none">
                            @if (!empty($cat->optionsSelected))
                                @foreach ($cat->optionsSelected as $prop)
                                    @if (gettype($prop) != 'array')
                                        <option value="{{$prop->id}}Selected">{{$prop->name}}</option>
                                    @else 
                                        <option value="{{$prop['id']}}Selected">{{$prop['name']}}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        
                        <div x-data="dropdownProperties()" x-init="loadOptions({{$cat->category}})" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
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

                
                @endforeach
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 md:sm:grid-cols-3 lg:sm:grid-cols-6 gap-3 sm:gap-2 md:gap-2 lg:gap-2">
        @foreach ($products as $item)
        <div class="flex bg-white dark:bg-gray-800 rounded-sm shadow-md hover:shadow-lg py-4">
            <div class="flex-none w-48 relative">
                <img src="{{ Storage::disk('dropbox')->url("{$item->photo->filename}") }}" alt="{{$item->name}}" class="absolute rounded-lg inset-0 w-full h-full object-cover"/>
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
        id : null,
        idSelected : null,
        options: [],
        selected: [],
        show: false,
        open() { this.show = true },
        close() { this.show = false },
        isOpen() { return this.show === true },
        select(index, event = null) {

            let optionsSelected = document.getElementById(this.id).options;
            console.log(event)

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
                        console.log(this.options[index]);
                        let opt = document.getElementById(optionsSelected[i].id).click();
                    }                    
                }
            }
        },
        remove(index, option) {
            this.options[option].selected = false;
            this.selected.splice(index, 1);

            let optionsSelected = document.getElementById(this.idSelected).options;

            for (let i = 0; i < optionsSelected.length; i++) {

                if (this.options[index].value == optionsSelected[i].value) {
                    let opt = document.getElementById(optionsSelected[i].id).click();
                }                    
            }

        },
        loadOptions(cat) {


            this.id = cat.id;
            this.idSelected = cat.id +'Selected';

            const options = document.getElementById(this.id).options, 
                optionsSelected = document.getElementById(this.idSelected).options;

            for (let i = 0; i < options.length; i++) {

                this.options.push({
                    value: options[i].value,
                    text: options[i].innerText,
                    selected: options[i].getAttribute(this.idSelected) != null ? options[i].getAttribute(this.idSelected) : false
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
