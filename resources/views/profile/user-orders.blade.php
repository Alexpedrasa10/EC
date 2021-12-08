<div>

    <div>
        <h1 class="text-xl py-5 font-semibold">Mis Ordenes</h1>
    </div>

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    N° Orden
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Dirección
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Precio
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Estado
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($orders as $order)
                        <tr>
                            <td class="px-6 py-3 whitespace-nowrap text-sm">
                                #{{$order->order->id}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowraps">              
                                <span class="text-xs">
                                    {{$order->order->adress->adress}} <br>
                                ({{$order->order->adress->provinceName}}, {{$order->order->adress->cityName}})
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowraps">              
                                <span class="text-base font-bold text-green-600">
                                    {{$order->order->total_amount}} {{$order->order->asset()->first()->code}} <br>
                                </span>
                            </td>
                            <td class="whitespace-nowrap text-left">    
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{$order->order->status()->first()->name}}
                                </span>            
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
  
</div>
