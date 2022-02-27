<div>

    <div class="py-5">
        <h1 class="text-xl font-semibold">Mis ventas</h1>
        <p class="text-sm">Este es el historial de ventas que has realizado.</p>
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
                    <th></th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($orders as $order)
                        <tr>
                            <td class="px-6 py-3 whitespace-nowrap text-sm">
                                #{{$order->id}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowraps">              
                                <span class="text-xs">
                                    {{$order->adress->adress}} <br>
                                ({{$order->adress->provinceName}}, {{$order->adress->cityName}})
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowraps">              
                                <span class="text-base font-bold text-green-600">
                                    {{$order->total_amount}} {{$order->asset->code}} <br>
                                </span>
                            </td>
                            <td class="whitespace-nowrap text-left">    
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{$order->status->code}}">
                                    {{$order->status->name}}  {{$order->status->code}} 
                                </span>            
                            </td>
                            <td>
                                <span x-data="{}" x-on:click="window.livewire.emitTo('order-info', 'show', {{$order->id}})"title="Ver más" class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
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

<style lang="css">
    
    .SUCC {
        color: #F1F1F1;
        background: #17b917;
        border-radius: 1rem;
    }

    .PEND {
        background: #e06d20;
        border-radius: 1rem;
        color : #F1F1F1F1;
    }
    

</style>
