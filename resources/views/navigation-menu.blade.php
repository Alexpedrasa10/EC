@php
    $navLinks = [
        ['name' => 'Hombres', 'route' => 'productos', 'code' => "MEN" ],
        ['name' => 'Mujer', 'route' => 'productos', 'code' => "WOMEN" ],
    ];

    if (Auth::user()) {
        
        $user = App\Models\User::whereId(Auth::user()->id)->first();
        $teamAdmin = App\Models\Team::whereName('Administracion')->first();
        $isAdmin = $user->belongsToTeam($teamAdmin);
    }
@endphp


<nav x-data="{ open: false }" class="bg-gray-50 border-b border-gray-100 w-full z-40">
    
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-jet-nav-link>

                    @foreach ($navLinks as $nav)
                        <x-jet-nav-link href="{{ route($nav['route'], [
                            'category' => $nav['code']
                        ]) }}">
                            {{ __($nav['name']) }}
                        </x-jet-nav-link>
                    @endforeach

                    @if (isset($isAdmin) && $isAdmin)
                    <x-jet-nav-link href="{{ route('myProducts') }}">
                        {{ __('Mis Productos') }}
                    </x-jet-nav-link>
                    @endif
                </div>
            </div>
            @auth
            <div class="hidden sm:flex sm:items-center sm:ml-6">

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">

                            @if (!$isAdmin)
                                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Mi Perfil') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            @if (Auth::user()->id == 1)
                                
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('My Ecommerce') }}
                                </div>

                                <x-jet-dropdown-link href="{{ route('myProducts') }}">
                                    {{ __('Mis Productos') }}
                                </x-jet-dropdown-link>

                                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Mis ventas') }}
                                </x-jet-dropdown-link>
                                <hr>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>
            @else
           
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

                @foreach (\Helper::getLoginMethods() as $log)
                    <x-jet-button 
                        class="{{json_decode($log->data)->class}}">
                        <a href="{{ route('socialite', ['driver' => "{$log->name}"]) }}" class="text-center">
                            {{ __('Ingresar con ') }} {{$log->name}}
                        </a>
                    </x-jet-button>
                @endforeach
                <x-jet-button class="my-3 inline-block transition ease-in duration-200 rounded-sm shadow-lg bg-gray-400 hover:bg-gray-600 text-center">
                    <a href="{{ route('login') }}" class="text-center">
                        {{ __('Ingresar ') }}
                    </a>
                </x-jet-button>
            </div>
            @endauth
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link>
            
            @foreach ($navLinks as $nav)
                <x-jet-responsive-nav-link href="{{ route($nav['route']) }}" :active="request()->is($nav['route'])">
                    {{ __($nav['name']) }}
                </x-jet-responsive-nav-link>
            @endforeach

            @auth
            @else 
                <x-jet-responsive-nav-link href="{{ route('login') }}" active>
                    {{ __('Ingresar ') }}
                </x-jet-responsive-nav-link>
            @endauth
        </div>
        @auth
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="flex-shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-jet-dropdown-link href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                            this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-jet-dropdown-link>
            </form>
        </div>
        @endauth
    </div>
</nav>