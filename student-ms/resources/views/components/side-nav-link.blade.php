@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'block py-4 px-2 leading-5 text-gray-100 bg-gray-600 focus:bg-gray-400 transition duration-150 ease-in-out rounded-md'
            : 'block py-4 px-2 text-gray-100 hover:bg-gray-600 focus:bg-gray-400 transition duration-150 ease-in-out rounded-md';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
