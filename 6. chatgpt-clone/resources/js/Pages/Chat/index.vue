<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

// The 'chats' prop is passed from the controller to the component
const props = defineProps({
  chats: Array,  // List of chat objects
});

// Sidebar toggle state
const isSidebarOpen = ref(false);

// Toggle sidebar visibility
const toggleSidebar = () => {
  isSidebarOpen.value = !isSidebarOpen.value;
};

// Close sidebar when clicking on overlay
const closeSidebar = () => {
  isSidebarOpen.value = false;
};
</script>

<template>
    <Head title="Chats" />

    <AuthenticatedLayout>
        <div class="flex w-full min-h-[calc(100vh-4rem)]">
            <div class=" flex-grow-1 relative w-full items-stretch grid sm:grid-cols-4">
            <!-- Overlay (Visible when sidebar is open) -->
                <div
                    v-if="isSidebarOpen"
                    @click="closeSidebar"
                    class="fixed inset-0 bg-black bg-opacity-50 z-40 sm:hidden"
                ></div>

                <!-- Sidebar -->
                <div
                    :class="[
                    'absolute sm:relative sm:w-[100%] top-0 left-0 h-full w-3/4 bg-slate-900 transform transition-transform duration-300 z-50 sm:translate-x-0',
                    isSidebarOpen ? 'translate-x-0' : '-translate-x-full',
                    ]"
                >
                    <ul v-if="chats.length>0">
                        <!-- Loop through the chats array and display each title -->
                        <li
                        v-for="chat in chats"
                        :key="chat.id"
                        class="text-white text-sm py-2 border-b border-slate-700"
                        >
                        {{ chat.title }} <!-- Display the chat title -->
                        </li>
                    </ul>
                </div>

                <!-- Main Content -->
                <div class="col-span-3 p-4 bg-slate-600 relative sm:col-span-3">
                    <!-- Hamburger Button (Visible only on small screens) -->
                    <button
                    @click="toggleSidebar"
                    class="mb-1 sm:hidden bg-gray-800 text-white p-2 rounded-md"
                    >
                    <!-- Hamburger Icon -->
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16m-7 6h7"
                        />
                    </svg>
                    </button>

                    <!-- Main Content Area -->
                    <div class="flex flex-col h-[100%]">
                        <!-- Messages Section -->
                        <div class="flex-grow p-4 overflow-y-auto">
                            <!-- Messages go here -->
                        </div>

                        <!-- Input and Send Button Section -->
                        <div class="flex flex-row p-4 mt-4">
                            <!-- Input Field -->
                            <input type="text" name="message" placeholder="Type a message..."
                                class="flex-grow border rounded-full border-slate-900 bg-slate-200 px-4 py-2 text-sm focus:outline-none"/>

                            <!-- Send Button -->
                            <button class="ml-4 p-3 rounded-full bg-slate-900 text-slate-100 hover:bg-slate-700 focus:outline-none">
                                <!-- Send Icon (You can use any icon here) -->
                                <svg fill="currentColor" height="24x" width="24px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                    viewBox="0 0 495.003 495.003" xml:space="preserve">
                                    <g id="XMLID_51_">
                                        <path id="XMLID_53_" d="M164.711,456.687c0,2.966,1.647,5.686,4.266,7.072c2.617,1.385,5.799,1.207,8.245-0.468l55.09-37.616
                                            l-67.6-32.22V456.687z"/>
                                        <path id="XMLID_52_" d="M492.431,32.443c-1.513-1.395-3.466-2.125-5.44-2.125c-1.19,0-2.377,0.264-3.5,0.816L7.905,264.422
                                            c-4.861,2.389-7.937,7.353-7.904,12.783c0.033,5.423,3.161,10.353,8.057,12.689l125.342,59.724l250.62-205.99L164.455,364.414
                                            l156.145,74.4c1.918,0.919,4.012,1.376,6.084,1.376c1.768,0,3.519-0.322,5.186-0.977c3.637-1.438,6.527-4.318,7.97-7.956
                                            L494.436,41.257C495.66,38.188,494.862,34.679,492.431,32.443z"/>
                                    </g>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
