<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none  disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
