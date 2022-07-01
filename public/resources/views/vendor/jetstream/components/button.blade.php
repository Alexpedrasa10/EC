<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-center px-4 py-2 bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-900 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
