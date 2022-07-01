<div class="bg-indigo-600" x-data="{ show : @entangle('show') }" x-show="show">
    <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between flex-wrap">
        <div class="w-full flex-1 mb-5 flex items-center sm:order-2 sm:mb-0 sm:w-auto">
                <span class="flex p-2 rounded-lg bg-indigo-800 text-white">
                    <a href="/cart">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </a>
                </span>
          <p class="ml-3 font-medium text-white truncate">
            <span class="md:hidden">
                Tus productos te están esperando!
            </span>
            <span class="hidden md:inline">
                Tus productos te están esperando!
            </span>
          </p>
        </div>
        <div class="order-3 m-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
          <a href="/cart" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50">
            Ver carrito
          </a>
        </div>
        <div class="order-3 m-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
            <a href="/checkout-payment" class="flex items-center justify-center px-4 py-2 border border-white rounded-md shadow-sm text-sm font-medium text-white bg-none ease-in-out">
              Terminar compra
            </a>
          </div>
      </div>
    </div>
</div>