@props(['title' => config('app.name') ])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="bg-slate-50 text-slate-800 dark:bg-black dark:text-white/50">
        <div class="relative min-h-screen flex flex-col items-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full px-6">
                <header class="flex items-center justify-between py-6 px-4 sm:px-6 lg:px-8">
                    <!-- Left Section: Logo, App Name, and Links -->
                    <div class="flex items-center space-x-6">
                        <!-- Logo and App Name -->
                        <div class="flex items-center space-x-2">
                            <x-application-logo
                                class="block h-9 w-auto fill-current text-slate-900 dark:text-gray-200" />
                            <div class="text-xl font-bold">{{ config('app.name') }}</div>
                        </div>

                        <!-- Navigation Links -->
                        <nav class="flex space-x-4">
                            @foreach ([
                                    ['href' => route('home'), 'label' => 'Home'], 
                                    ['href' => route('about'), 'label' => 'About Us'], 
                                    ['href' => route('contact'), 'label' => 'Contact Us'], 
                                    ['href' => route('post.index'), 'label' => 'All Posts']
                                ] as $link)
                                    <x-nav-link :href="$link['href']" :label="$link['label']" />
                            @endforeach
                        </nav>
                    </div>

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm">
                                My Account
                                <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="'#'">
                                Profile
                            </x-dropdown-link>
                            <x-dropdown-link :href="'#'">
                                Log Out
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>


                </header>


                <main class="mt-6 w-full h-full flex-grow">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
</body>

</html>
