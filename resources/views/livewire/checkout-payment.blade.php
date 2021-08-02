<div>
    <div class="bg-gray-50 container p-10 rounded-sm">

        <main class="my-8">
            <h3 class="text-gray-700 text-2xl font-medium">Checkout</h3>
            <p class="text-sm text-gray-700">¡ Ya casi terminas tu compra ! Completa los siguientes campos para poder enviartelos a donde desees.</p>
            <div class="container mx-auto px-6">
                <div class="flex flex-col lg:flex-row mt-8">
                    <div class="w-full lg:w-1/2 order-2">
                            <h5 class="text-gray-900 text-xl">Envío</h5>
                            <div class="flex flex-wrap py-2">
                              <div class="w-full px-3 mb-6 md:mb-0 py-5">
                                <div class="relative">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-province">
                                        Provincia
                                    </label>
                                    <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-province">
                                        <option value="">Elige una Provincia</option>
                                        @foreach ($provinces as $prov)
                                            <option wire:click="getCities({{$prov->id}})" value="{{$prov->id}}">
                                                {{$prov->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('province') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                              </div>
                                  
                                <div class="w-full px-3 mb-6 md:mb-0 py-5">
                                    <div class="relative">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                            Ciudad
                                        </label>
                                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                                <option value="">Elige una ciudad</option>
                                                @if (!empty($cities))
                                                    @foreach ($cities as $city)
                                                        <option wire:click="setCity({{$city->id}})" value="{{$city->id}}">
                                                            {{$city->name}}
                                                        </option>
                                                    @endforeach
                                                @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="w-full px-3 mb-6 md:mb-0 py-5">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                                    Dirección
                                    </label>
                                    <input wire:model="adress" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-city" type="text" placeholder="Ej. Av Las Malvinas 247">
                                    @error('adress') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0 py-5">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                                    Código postal
                                    </label>
                                    <input wire:model="zipCode" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-zip" type="text" placeholder="Ej. 5000">
                                    @error('zipCode') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0 py-5">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                                    Piso <span class="text-xs text-gray-500">(Opcional)</span>
                                    </label>
                                    <input wire:model="piso" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-zip" type="text" placeholder="Ej. 2">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0 py-5">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                                    Dpto <span class="text-xs text-gray-500">(Opcional)</span>
                                    </label>
                                    <input wire:model="departmento" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-zip" type="text" placeholder="Ej. A45">
                                </div>
                                <div class="w-full px-3 mb-6 md:mb-0 py-5">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                                    Referencias <span class="text-xs text-gray-500">(Opcional)</span>
                                    </label>
                                    <input wire:model="references" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-city" type="text" placeholder="Ej. Casa con rejas blancas">
                                </div>
                                </div>
                    </div>
                    <div class="w-full mb-8 flex-shrink-0 order-1 lg:w-1/2 lg:mb-0 lg:order-2 p-3">
                        <h5 class="text-gray-900 text-xl">Mi orden</h5>
                        <div class="container py-2 flex flex-col mx-auto w-full items-center justify-center bg-white dark:bg-gray-800 rounded-lg shadow">
                            @foreach ($products as $item)
                            <ul class="flex flex-col divide divide-y">
                                <li class="flex flex-row">
                                    <div class="select-none cursor-pointer flex flex-1 items-center p-4">
                                        <div class="flex flex-col w-10 h-10 justify-center items-center mr-4">
                                            <a class="block relative">
                                                <img alt="{{$item->product->name}}" src="{{$item->product->url_photos}}" class="mx-auto object-cover rounded-full h-10 w-10 "/>
                                            </a>
                                        </div>
                                        <div class="flex-1 pl-1 mr-16">
                                            <div class="font-medium dark:text-white">
                                                {{$item->product->name}}
                                            </div>
                                            <div class="text-gray-600 dark:text-gray-200 text-sm">
                                                x {{intval($item->quantity)}}
                                            </div>
                                        </div>
                                        <div class="text-gray-600 dark:text-gray-200 text-xs">
                                            ${{$item->amount}}
                                        </div>
                                        <button class="w-24 text-right flex justify-end">
                                            <svg width="20" fill="currentColor" height="20" class="hover:text-gray-800 dark:hover:text-white dark:text-gray-200 text-gray-500" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1363 877l-742 742q-19 19-45 19t-45-19l-166-166q-19-19-19-45t19-45l531-531-531-531q-19-19-19-45t19-45l166-166q19-19 45-19t45 19l742 742q19 19 19 45t-19 45z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </li>
                            </ul>
                            @endforeach
                            <ul>
                                <li class="text-xl text-gray-900 font-bold">
                                   Total :  ${{$cart->amount}}
                                </li>
                            </ul>
                        </div>
    
                    </div>
                </div>
            </div>
            <div class="container mx-auto px-6 w-full">
                    <p class="text-gray-800 text-medium py-3">Para finalizar, elige un método de pago: </p>
                    @foreach ($paymentMethods as $method)
                        <x-jet-button class="bg-blue-600 hover:bg-blue-900" title="{{$method->name}}">
                            <a wire:click="pay({{$method->id}})" >
                                {{$method->name}}
                            </a>
                        </x-jet-button>
                    @endforeach
            </div>
        </main>
    </div>
</div>
