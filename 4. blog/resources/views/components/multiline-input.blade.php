@props(['name', 'id', 'rows' => 4, 'label'])

<div class="mb-4">
    <!-- Dynamic Label -->
    <label for="{{ $id }}" class="block text-gray-700">{{ $label }}</label>

    <!-- Dynamic Textarea Field -->
    <textarea id="{{ $id }}" name="{{ $name }}" rows="{{ $rows }}" required
        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg 
            focus:ring-slate-800 focus:border-slate-800 dark:bg-slate-800 dark:text-white
            dark:border-slate-600 dark:focus:ring-white"></textarea>
</div>
