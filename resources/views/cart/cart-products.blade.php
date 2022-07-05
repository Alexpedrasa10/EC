<div class="container">
  <h2 class="text-2xl font-bold dark:text-black">Mi carrito de compras</h2>
  <p class="text-sm font-light text-gray-600">Estos son todos los productos en tu carrito de compras.</p>
  
  <!-- Tabla -->
  <div class="flex flex-col mt-5">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Producto
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Cantidad
                </th>
                <th scope="col" class=" text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach ($products as $item)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <img class="w-10 h-19" 
                      src="{{ Storage::disk('dropbox')->url("{$item->url}") }}"
                      alt="{{$item->name}}">
                    <a class="text-black hover:text-blue-700 font-bold" href="/producto/{{$item->slug}}">{{$item->name}}</a>  
                    <br>
                    @if (is_null($item->sale_price))
                      <span class="text-sm text-gray-500">
                        ${{$item->unit_price}} p/ unidad.
                      </span>
                    @else
                    <span class="block text-xs line-through text-red-400">${{$item->unit_price}} p/ unidad</span>
                      <span class="text-sm text-gray-500">
                        ${{$item->sale_price}} p/ unidad. 
                      </span>
                    @endif
                    
                    <br>
                      <p class="text-xs text-gray-500">Total:</p>
                      <span class="text-gray-900 text-1xl font-bold">
                        ${{$item->amount}}
                      </span>
                </td>
                <td class="px-6 py-4 whitespace-nowraps">              
                  @foreach ( $this->getSizes($item->data) as $order)
                      <div class="flex items-center py-2">
                        <button wire:click="decrement( {{$item->id}}, '{{$order->size}}' )" class="hover:text-black text-gray-500 focus:outline-none focus:text-gray-600" title="Quitar">
                          <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </button>
                        <span class="text-center text-gray-600 text-sm px-5">{{$order->quantity}} en {{$order->size}}</span>
                        <button wire:click="increment( {{$item->id}}, '{{$order->size}}' )" class="hover:text-black text-gray-500 focus:outline-none focus:text-gray-600" title="Agregar">
                          <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </button>
                      </div><br>
                  @endforeach
                </td>
                <td class="whitespace-nowrap text-left">                
                  <div class="inline-flex">
                    <span class="px-2 cursor-pointer text-1xl text-red-500 hover:text-red-900" title="Eliminar {{$item->name}} del carrito." 
                      wire:click="confirmDeleteProduct({{ $item->id }})">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                      </svg>
                    </span>
                  </div>
                </td>
              </tr>
              @endforeach
              <!-- More people... -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="py-2">
    <div class="container mt-5">
      <h1 class="antialiased text-1xl font-bold uppercase ">Total a pagar : 
        <br>
        <p class="text-green-700 text-2xl font-bold lining-nums slashed-zero">
          ${{$cart->amount}}
        </p>
      </h1>
    </div>
  </div>

  <div class="container my-5 text-center">
    <x-jet-button  class=" duration-200 bg-blue-600 hover:bg-blue-800 ease-in-out">
        <a href="{{ route('checkout') }}">Terminar compra</a>
    </x-jet-button>
    <x-jet-button wire:click="cancelCart" class="duration-200 bg-red-600 hover:bg-red-800 ease-in-out">
        Cancelar compra
    </x-jet-button>
  </div>

  <!-- Envio -->
  {{--  --}}
</div>