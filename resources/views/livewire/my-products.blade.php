<div class="my-15 w-full">
    <h1 class="text-2xl font-bold">Mis productos</h1>
    <p class="text-base font-light text-gray-600">Estos son todos los productos cargados en tu Ecommerce.</p>

    <div class="grid grid-cols-3 gap-1 mt-5 w-full">
      
      <div class="w-full">
        <label class=" text-gray-500 py-2">Filtrar por</label>
        <select wire:model="filter" class="block text-grey-darker border border-gray-200 rounded-lg w-full sm:w-1/5 md:w-2/5 " required="required" name="integration[city_id]" id="integration_city_id">
            <option value="null">Todos</option>
            <option value="priceLower">Precio más bajo</option>
            <option value="priceHigher">Precio más alto</option>
            <option value="sale">En oferta</option>
        </select>
      </div>

      <div class="w-full">
        <label class="block text-gray-600" for="productName">Nombre</label>
        <x-jet-input id="productName" type="text" wire:model="productName"/>
      </div>

      <div class="w-full">
        <label class=" text-gray-500 py-2">Categorias</label>
        <select wire:model="category" class="block text-grey-darker border border-gray-200 rounded-lg w-full sm:w-1/5 md:w-2/5 " required="required" name="integration[city_id]" id="integration_city_id">
            <option value="null">Todas</option>
            @foreach ($categories as $cat)
              <option value="{{$cat->id}}">{{$cat->name}}</option>
            @endforeach
        </select>
      </div>

    </div>

    <div class="my-10">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Producto
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Stock
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Categorias
                </th>
                <th scope="col" class=" text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach ($products as $item)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <img class="w-10 h-19" src="{{$item->url_photos}}" alt="{{$item->name}}">
                    <a class="text-black hover:text-blue-700 font-bold" href="/productos/{{$item->slug}}">{{$item->name}}</a>  
                    <br>
                    @if (is_null($item->sale_price))
                      <span class="text-sm text-gray-500">
                        ${{$item->price}} p/ unidad.
                      </span>
                    @else
                    <span class="block text-xs line-through text-red-400">${{$item->price}} p/ unidad</span>
                      <span class="text-sm text-gray-500">
                        ${{$item->sale_price}} p/ unidad. 
                      </span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowraps">              
                    {{$item->stock}} <br>
                    <span class="text-gray-500 text-sm text-center">({{$this->getStockData($item->data)}})</span>
                </td>
                <td>
                  @if (!empty($item->properties))
                  <span class="text-gray-500 text-sm text-center">
                    {{$this->getPropertiesStr($item->properties)}}
                  </span>
                  @endif
                </td>
                <td class="whitespace-nowrap text-left">                
                  <div class="inline-flex">
                    <a class="px-2 cursor-pointer text-1xl text-blue-700 hover:text-blue-900" title="Editar"
                    href="/edit-product/{{$item->slug}}">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                      </svg>
                    </a>
                    <a class="px-2 cursor-pointer text-1xl text-red-500 hover:text-red-900" title="Eliminar {{$item->name}} del carrito." 
                      wire:click="confirmDeleteProduct({{ $item->id }})">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                      </svg>
                    </a>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>    
</div>
