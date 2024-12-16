@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'block py-4 px-2 leading-5 text-blue-100 bg-blue-600 focus:bg-blue-400 transition duration-150 ease-in-out rounded-md'
            : 'block py-4 px-2 text-blue-100 hover:bg-blue-600 focus:bg-blue-400 transition duration-150 ease-in-out rounded-md';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
