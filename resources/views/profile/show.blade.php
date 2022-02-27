@php
if (Auth::user()) {
        
    $user = App\Models\User::whereId(Auth::user()->id)->first();
    $teamAdmin = App\Models\Team::whereName('Administracion')->first();
    $isAdmin = $user->belongsToTeam($teamAdmin);
}
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if ($isAdmin)
                @livewire('all-orders')
            @else
                @livewire('user-orders')
            @endif
            <x-jet-section-border />
        </div>
    </div>
</x-app-layout>
