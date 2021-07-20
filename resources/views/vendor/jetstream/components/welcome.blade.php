<main class="my-8">
    <div class="container mx-auto px-6">
        <div class="h-64 rounded-md overflow-hidden bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1577655197620-704858b270ac?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1280&q=144')">
            <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
                <div class="px-10 max-w-xl">
                    <h2 class="text-2xl text-white font-semibold">Ropa deportiva</h2>
                    <p class="mt-2 text-gray-400">En esta tienda encontraras ropa deportiva de las marcas mas conocidas!</p>
                    <x-jet-button class="flex items-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                        <a href="{{ route('productos', ['category' => "SPORT"]) }}">Ver más</a>
                        <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </x-jet-x-jet-button>
                </div>
            </div>
        </div>
        <div class="md:flex mt-8 md:-mx-4">
            <div class="w-full h-64 md:mx-4 rounded-md overflow-hidden bg-cover bg-center md:w-1/2" style="background-image: url('https://phantom-marca.unidadeditorial.es/ef3b0d74c1c2701b5034ec36b80095c1/resize/1320/f/jpg/assets/multimedia/imagenes/2021/05/14/16210022936942.jpg')">
                <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
                    <div class="px-10 max-w-xl">
                        <h2 class="text-2xl text-white font-semibold">PSG - JORDAN</h2>
                        <p class="mt-2 text-gray-400">Toda la colección de PSG y JORDAN la podes encontrar acá y al mejor precio.</p>
                        <x-jet-button class="flex items-center mt-4 text-white text-sm uppercase font-medium rounded hover:underline focus:outline-none">
                            <span>Ver más</span>
                            <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </x-jet-button>
                    </div>
                </div>
            </div>
            <div class="w-full h-64 mt-8 md:mx-4 rounded-md overflow-hidden bg-cover bg-center md:mt-0 md:w-1/2" style="background-image: url('https://imagesa1.lacoste.com/dw/image/v2/BCWL_PRD/on/demandware.static/-/Library-Sites-LacosteContent/default/dw308eb0ff/fw19/brand%20section/lacosteinside-collabs/lacosteinside-collabs-push-component-tile-basic-5-desktop.jpg?imwidth=840&impolicy=custom')">
                <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
                    <div class="px-10 max-w-xl">
                        <h2 class="text-2xl text-white font-semibold">Hype</h2>
                        <p class="mt-2 text-gray-400">Las mejores marcas, la mejor calidad.</p>
                        <x-jet-button class="flex items-center mt-4 text-white text-sm uppercase font-medium rounded hover:underline focus:outline-none">
                            <span>Ver más</span>
                            <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </x-jet-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>