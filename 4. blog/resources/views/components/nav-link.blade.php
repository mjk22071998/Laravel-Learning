@props(['href', 'label', 'extraClass' => ''])

<a href="{{ $href }}"
    class="rounded-md px-3 py-2 hover:bg-slate-300 text-black ring-1 ring-transparent transition focus:outline-none dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white {{ $extraClass }}">
    {{ $label }}
</a>
