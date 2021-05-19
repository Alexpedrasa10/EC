<div>
  <h2 class="text-3xl font-bold mb-5 dark:text-black">Mi carrito</h2>
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Nombre
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Precio p/unidad
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Cantidad
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Precio total
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Acción
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach ($products as $item)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{$item->name}}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    ${{$item->unit_price}}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">              
                  {{$item->quantity}}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">                
                  ${{$item->amount}}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-left">                
                  <div class="inline-flex">
                    <span class="px-2 cursor-pointer text-1xl text-blue-700 hover:text-blue-900" title="Editar"
                      wire:click="showModelEditProduct({{ $item->id }})">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                      </svg>
                    </span>
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

    <div class="flex justify-end py-2">
      <div class="container mt-5 float-right">
        <h1 class="antialiased text-1xl font-bold uppercase text-right">Total a pagar : 
          <br>
          <p class="text-black text-3xl lining-nums slashed-zero">
            ${{$cart->amount}}
          </p>
        </h1>
        <div class="float-right">
          <button class="bg-blue-600 uppercase text-white dark:text-white p-3 mt-1" wire:click="paymentMercadopago">
            Procesar pago
          </button>
          <button class="bg-red-600 uppercase text-white dark:text-white p-3 mt-1">
            Cancelar compra
          </button>
        </div>
      </div>
    </div>

  </div>

  <!--Modal para confirmar la eliminación de un producto-->
  @if ($confirmDeleteProduct)
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
                    Eliminar producto
                  </h3>
                  <div class="mt-2">
                    <p class="text-sm text-gray-500">
                      Estas a punto de eliminar este producto de tu carrito de comprar. ¿Estás seguro de eliminar?
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
              <a wire:click="deleteProduct" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm cursor-pointer">
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

 <!--Modal para confirmar la eliminación de un producto-->
 @if ($editProductCart)
  <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
    
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true"></span>
    
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left p-5">
                <div class="mt-2">
                  <h2 class="text-2xl font-bold">{{$productEditName}} x ${{$productEditUnitPrice}}</h2>
                </div>
                <div class="mt-2">
                  <label class="block text-sm font-medium text-gray-700">Cantidad</label>
                  <select class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @foreach ($stock as $s)
                      <option wire:click="updateAmount( {{$s}} )">{{$s}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mt-5">
                  <h2  class="block text-sm font-medium text-gray-700">Total: <br> 
                    <span class="font-bold text-2xl text-green-700">${{$productEditAmount}}</span>
                  </h2>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <a wire:click="editProduct" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm cursor-pointer">
              Editar
            </a>
            <a wire:click="cancelEditProduct" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm cursor-pointer">
              Cancelar
            </a>
          </div>
        </div>
      </div>
    </div>
  
  </div>
  @endif

</div>