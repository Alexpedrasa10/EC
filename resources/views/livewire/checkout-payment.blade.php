<div class="h-screen">

	<div x-data="{ step: @entangle('steps') }" x-cloak>
		<div class="max-w-3xl mx-auto px-4 py-10">

			<div>	
				<!-- Top Navigation -->
				<div class="border-b-2 py-4">
					<div class="uppercase tracking-wide text-xs font-bold text-gray-500 mb-1 leading-tight" x-text="`Paso: ${step} de 2`"></div>
					<div class="flex flex-col md:flex-row md:items-center md:justify-between">
						<div class="flex-1">
							<div x-show="step === 1">
								<div class="text-lg font-bold text-gray-700 leading-tight">Envío</div>
							</div>
							
							<div x-show="step === 2">
								<div class="text-lg font-bold text-gray-700 leading-tight">Elige método de pago</div>
							</div>

						</div>
					</div>
				</div>
				<!-- /Top Navigation -->

				<!-- Step Content -->
				<div class="py-10">	
					<div x-show.transition.in="step === 1">
						<form>
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
                                <div class="grid grid-cols-3 col-span-1">
                                    <div class="w-full px-3 mb-6 md:mb-0 py-5">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                                        Código postal
                                        </label>
                                        <input wire:model="zipCode" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-zip" type="text" placeholder="Ej. 5000">
                                        @error('zipCode') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="w-full px-3 mb-6 md:mb-0 py-5">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                                        Piso <span class="text-xs text-gray-500">(Opcional)</span>
                                        </label>
                                        <input wire:model="piso" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-zip" type="text" placeholder="Ej. 2">
                                    </div>
                                    <div class="w-full px-3 mb-6 md:mb-0 py-5">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                                        Dpto <span class="text-xs text-gray-500">(Opcional)</span>
                                        </label>
                                        <input wire:model="departmento" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-zip" type="text" placeholder="Ej. A45">
                                    </div>
                                </div>
                                <div class="w-full px-3 mb-6 md:mb-0 py-5">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                                    Referencias <span class="text-xs text-gray-500">(Opcional)</span>
                                    </label>
                                    <input wire:model="references" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-city" type="text" placeholder="Ej. Casa con rejas blancas">
                                </div>
                            </div>
                        </form>
					</div>
					<div x-show.transition.in="step === 2">

						<div class="mb-5">
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
                        </div>
					</div>
				</div>
				<!-- / Step Content -->
			</div>
            <!-- Bottom Navigation -->	
            <div class="fixed bottom-0 left-0 right-0 py-5 bg-white shadow-md">
                <div class="max-w-3xl mx-auto px-4">
                    <div class="flex justify-between">
                        <div class="w-1/2">
                            <button
                                x-show="step == 2"
                                @click="step--"
                                class="w-32 focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border" 
                            >Anterior</button>
                        </div>

                        <div class="w-1/2 text-right">
                            <button
                                x-show="step == 1"
                                wire:click="saveAddress"
                                class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium" 
                            >Siguiente</button>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>