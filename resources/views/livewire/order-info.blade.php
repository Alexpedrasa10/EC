<div>
    @if (!empty($order))
    <x-modal wire:model="show"> {{-- <-- Add this --}}
        <div class="p-10">
            <h2 class="text-xl font-semibold my-2">Información de la compra</h2>

            <p class="text-sm py-3 font-semibold">Productos</p>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nombre    
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Cantidad
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Precio
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($order->cart->products as $item)
                      <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{$item->product->name}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                              @if (!empty($item->data))
                                  <span class="text-sm font-medium text-gray-700">
                                      ({{$this->getStockData($item->data)}})
                                  </span>
                              @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap"> 
                              $ {{$item->amount}} c/u
                            </td>
                      </tr>
                  @endforeach
                </tbody>
            </table>

        </div>
    </x-modal>
    @endif
</div>
