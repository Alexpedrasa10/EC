<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <!--Modal para confirmar la cancelar el carrito-->
        @livewire('delete-cart', ['user' => Auth::user()])

        <!--Modal para confirmar la eliminación de un producto-->
        @livewire('delete-product-cart', ['user' => Auth::user()])

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire('cart-products')
        </div>
    </div>
</x-app-layout>
