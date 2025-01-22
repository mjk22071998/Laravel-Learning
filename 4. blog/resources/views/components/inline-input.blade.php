@props(['name', 'id', 'type' => 'text', 'label'])

<!-- Dynamic Label -->
<label for="{{ $id }}" class="text-slate-700">{{ $label }}</label>

<!-- Dynamic Input Field with merged attributes -->
<input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" required class="block flex-1 px-4 py-2 border border-slate-300 rounded-lg 
        focus:ring-slate-800 focus:border-slate-800 dark:bg-slate-800 dark:text-white
        dark:border-slate-600 dark:focus:ring-white" {{ $attributes->merge(['class' => '']) }}>