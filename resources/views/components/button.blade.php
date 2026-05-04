
@props(['variant' => 'primary'])

<button {{ $attributes->merge([
    'class' => ($variant === 'outline' ? 
        'bg-white border-2 border-gray-300 hover:border-gray-400 hover:bg-gray-50 text-gray-800' : 
        'bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white shadow-lg hover:shadow-xl')
    . ' inline-flex items-center justify-center px-6 py-3 text-sm font-semibold rounded-xl transition-all duration-200 active:scale-95 shadow-md whitespace-nowrap'
]) }}>
    {{ $slot }}
</button>

