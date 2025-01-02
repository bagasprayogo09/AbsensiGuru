@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-2 rounded-md bg-indigo-600 text-white'
            : 'flex items-center px-4 py-2 rounded-md text-gray-300 hover:bg-gray-700 hover:text-white transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
