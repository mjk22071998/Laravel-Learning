@props([
    'API_KEY' => env('CK_EDITOR_KEY'),
    'name',
    'id',
    'label',
    'minWords' => null,
    'value' => null
])

<div class="relative mb-4">
    <!-- Dynamic Label -->
    <label for="{{ $id }}" class="block text-slate-700">{{ $label }}</label>

    <!-- Dynamic Textarea Field with merged attributes -->
    <textarea id="{{ $id }}" name="{{ $name }}" class="hidden"
        {{ $attributes->merge(['class' => '']) }} ></textarea>

    <div class="main-container">
        <div class="editor-container editor-container_classic-editor editor-container_include-style editor-container_include-word-count"
            id="editor-container">
            <div class="editor-container__editor">
                <div id="editor"></div>
            </div>
            <div class="editor_container__word-count" id="editor-word-count"></div>
        </div>
    </div>
</div>

<script>
        const LICENSE_KEY = @json($API_KEY);
</script>