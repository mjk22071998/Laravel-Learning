@props(['title', 'content', 'buttonLabel' => 'Read More'])

<div class="bg-slate-200 p-4 my-4 rounded-md">
    <h3 class="text-xl font-bold">{{ $title }}</h3>
    <div>
        {{ $content }}
    </div>
    <x-button size="small" label="{{ $buttonLabel }}" />
</div>
