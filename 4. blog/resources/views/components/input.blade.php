@props(['name', 'id', 'type' => 'text', 'label'])

<div class="mb-4">
    <!-- Dynamic Label -->
    <label for="{{ $id }}" class="block text-slate-700">{{ $label }}</label>

    <!-- Dynamic Input Field with merged attributes -->
    <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" required class="mt-1 block w-full px-4 py-2 border border-slate-300 rounded-lg 
            focus:ring-slate-800 focus:border-slate-800 dark:bg-slate-800 dark:text-white
            dark:border-slate-600 dark:focus:ring-white" {{ $attributes->merge(['class' => '']) }}>
</div>