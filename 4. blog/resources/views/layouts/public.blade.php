<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

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
                            <a href="{{ route('home') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent 
                                    transition hover:text-black/70 focus:outline-none 
                                    focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80
                                    dark:focus-visible:ring-white">
                                Home
                            </a>
                            <a href="{{ route('about') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent 
                                    transition hover:text-black/70 focus:outline-none 
                                    focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80
                                    dark:focus-visible:ring-white">
                                About Us
                            </a>
                            <a href="{{ route('contact') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent 
                                    transition hover:text-black/70 focus:outline-none 
                                    focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80
                                    dark:focus-visible:ring-white">
                                Contact Us
                            </a>
                        </nav>
                    </div>

                    <!-- Right Section: "My Account" Dropdown -->
                    <div class="relative">
                        <button id="dropdown-toggle"
                            class="inline-flex items-center px-4 py-2 bg-white text-black border border-gray-300 
            rounded-md hover:bg-gray-100 dark:bg-gray-800 dark:text-white dark:border-gray-600 
            focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                            My Account
                            <svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="dropdown-menu"
                            class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 
                                rounded-md shadow-lg hidden dark:bg-gray-800 dark:border-gray-600">
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 
                                    dark:text-gray-200 dark:hover:bg-gray-700">
                                View Profile
                            </a>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 
                                    dark:text-gray-200 dark:hover:bg-gray-700">
                                Settings
                            </a>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 
                                    dark:text-gray-200 dark:hover:bg-gray-700">
                                Logout
                            </a>
                        </div>
                    </div>
                </header>


                <main class="mt-6 w-full h-full flex-grow">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
</body>

</html>
