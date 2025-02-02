<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen max-h-screen overflow-hidden bg-slate-900">
            <nav class="bg-slate-800 shadow-lg">
                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 items-center justify-between">
                        <!-- Logo Section -->
                        <div class="flex items-center">
                            <Link :href="route('chats')" class="flex items-center space-x-3">
                                <ApplicationLogo class="h-10 w-10 shrink-0 fill-current text-indigo-400" />
                                <span class="text-xl font-bold tracking-tight text-slate-200">ChatApp</span>
                            </Link>
                        </div>

                        <!-- Right Navigation Section -->
                        <div class="flex items-center gap-6">
                            <!-- User Dropdown -->
                            <div class="relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <button class="flex items-center space-x-2 rounded-lg bg-slate-700/50 px-4 py-2.5 transition-all duration-200 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-slate-800">
                                            <span class="text-sm font-medium text-slate-200">
                                                {{ $page.props.auth.user.name }}
                                            </span>
                                            <svg class="h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </template>

                                    <template #content>
                                        <DropdownLink class="hover:bg-slate-700/50" :href="route('profile.edit')">
                                            Profile
                                        </DropdownLink>
                                        <DropdownLink class="text-red-400 hover:bg-red-500/10" :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>

                            <!-- Mobile Menu Button -->
                            <div class="flex items-center sm:hidden">
                                <button @click="showingNavigationDropdown = !showingNavigationDropdown"
                                    class="inline-flex items-center justify-center rounded-lg p-2 text-slate-400 transition-colors hover:bg-slate-700/50 hover:text-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path :class="{ 'hidden': showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }" 
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M4 6h16M4 12h16M4 18h16" />
                                        <path :class="{ 'hidden': !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" 
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{ 'block': showingNavigationDropdown, 'hidden': !showingNavigationDropdown }" 
                     class="sm:hidden border-t border-slate-700/50">

                    <div class="px-4 py-4 space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-base font-semibold text-slate-200">
                                    {{ $page.props.auth.user.name }}
                                </div>
                                <div class="text-sm font-medium text-slate-400">
                                    {{ $page.props.auth.user.email }}
                                </div>
                            </div>
                            <ApplicationLogo class="h-8 w-8 shrink-0 fill-current text-indigo-400" />
                        </div>

                        <div class="mt-3 space-y-2">
                            <ResponsiveNavLink class="hover:bg-slate-700/50" :href="route('profile.edit')">
                                Profile
                            </ResponsiveNavLink>
                            <ResponsiveNavLink class="text-red-400 hover:bg-red-500/10" :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main>
                <div class="rounded-xl bg-slate-800/50 border border-slate-700/50 shadow-lg p-6">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>