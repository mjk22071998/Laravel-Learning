@props(['name', 'id', 'rows' => 4, 'label', 'minWords' => null, 'value' => null])

<div class="relative mb-4">
    <!-- Dynamic Label -->
    <label for="{{ $id }}" class="block text-slate-700">{{ $label }}</label>

    <!-- Dynamic Textarea Field with merged attributes -->
    <textarea id="{{ $id }}" name="{{ $name }}" rows="{{ $rows }}"
        class="mt-1 block w-full px-4 py-2 border border-slate-300 rounded-lg 
            focus:ring-slate-800 focus:border-slate-800 dark:bg-slate-800 dark:text-white
            dark:border-slate-600 dark:focus:ring-white resize-none"
        {{ $attributes->merge(['class' => '']) }}
        @if ($minWords) data-min-words="{{ $minWords }}" @endif>{{ $value }}</textarea>

    <!-- Word count indicator -->
    @if ($minWords && $minWords > 0)
        <p id="{{ $id }}-word-count" class="absolute bottom-2 right-2 text-sm text-red-500">
            Min: {{ $minWords }} words
        </p>
    @endif
</div>
