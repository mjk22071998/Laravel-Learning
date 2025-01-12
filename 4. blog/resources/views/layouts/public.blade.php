<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="bg-gray-50 text-gray-800 dark:bg-black dark:text-white/50">
        <div class="relative min-h-screen flex flex-col items-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 pt-6">
                    <div class="flex flex-row justify-normal items-center">
                        <x-application-logo class="block h-9 w-auto fill-current text-slate-900 dark:text-gray-200" />
                        <div class="p-6 text-xl font-bold">{{ config('app.name') }}</div>
                    </div>
                    @if (Route::has('login'))
                        <nav class="-mx-3 flex justify-end">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent 
                                    transition hover:text-black/70 focus:outline-none 
                                    focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80
                                    dark:focus-visible:ring-white">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent 
                                    transition hover:text-black/70 focus:outline-none 
                                    focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80
                                    dark:focus-visible:ring-white">
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent 
                                        transition hover:text-black/70 focus:outline-none 
                                        focus-visible:ring-[#FF2D20] dark:text-white 
                                        dark:hover:text-white/80 dark:focus-visible:ring-white">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </header>

                <main class="mt-6 w-full h-full flex-grow">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
</body>

</html>
