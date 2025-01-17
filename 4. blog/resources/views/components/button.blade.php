@props(['size' => 'regular', 'label', 'href' => "#", 'type' => 'button', 'extraClass' => ''])

@php
// Define button classes based on the size
$buttonClasses = match ($size) {
    'large' => 'px-6 py-3 text-lg',
    'small' => 'px-3 py-1',
    default => 'px-4 py-2 text-md',
};
@endphp

<!-- Button with dynamic classes, label, and extra classes -->
<a href="{{ $href }}">
    <button type="{{ $type }}"
        class="font-semibold shadow-md focus:ring-slate-600 focus:ring-offset-2 focus:ring-2 block focus:outline-none hover:bg-slate-600 bg-slate-800 text-slate-100 rounded-lg {{ $buttonClasses }} {{ $extraClass }}">
        {{ $label }}
    </button>
</a>
