@props([
    'size' => 'regular',
    'label',
    'href' => null,
    'type' => 'button',
])

@php
$buttonClasses = match ($size) {
    'large' => 'px-6 py-3 text-lg',
    'small' => 'px-3 py-1',
    default => 'px-4 py-2 text-md',
};

$baseClasses = "font-semibold shadow-md focus:ring-slate-600 focus:ring-offset-2 focus:ring-2 focus:outline-none hover:bg-slate-600 bg-slate-800 text-slate-100 rounded-lg $buttonClasses";
@endphp

@if ($href)
    <a href="{{ $href }}">
        <button type="{{ $type }}" {{ $attributes->merge(['class' => $baseClasses]) }}>
            {{ $label }}
        </button>
    </a>
@else
    <a href="{{ $href }}">
        <button type="{{ $type }}" {{ $attributes->merge(['class' => $baseClasses]) }}>
            {{ $label }}
        </button>
    </a>
@endif