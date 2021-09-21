<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo class="text-center" />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div >
                <x-jet-button class="mt-5 inline-block bg-indigo-600 hover:bg-indigo-800 w-full rounded-lg shadow-lg text-center">
                    <span class="text-center">
                        {{ __('Log in') }}
                    </span>
                </x-jet-button>
            </div>

            <br>

            <div>
                <x-jet-button class="mt-5 inline-block w-full rounded-sm shadow-lg bg-blue-600 text-center">
                    <a href="{{ route('socialite', ['driver' => "facebook"]) }}" class="text-center">
                        {{ __('Ingresar con Facebook') }}
                    </a>
                </x-jet-button>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Olvidaste tu contraseña?') }}
                    </a>
                @endif
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    {{ __('No tienes cuenta? Registrate!') }}
                </a>
            </div>



        </form>
    </x-jet-authentication-card>
</x-guest-layout>
