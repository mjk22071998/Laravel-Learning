<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, watch, onMounted } from 'vue';

const props = defineProps({ chats: Array });
const isSidebarOpen = ref(false);
const selectedChat = ref(null);

onMounted(() => console.log(props.chats[0]));

const toggleSidebar = () => isSidebarOpen.value = !isSidebarOpen.value;
const closeSidebar = () => isSidebarOpen.value = false;
const selectChat = (chatId) => {
  selectedChat.value = props.chats.find(chat => chat.id === chatId);
  if (window.innerWidth < 640) closeSidebar();
};

watch(selectedChat, (newChat) => console.log("Selected Chat:", newChat));
</script>

<template>
    <Head title="Chats" />
    <AuthenticatedLayout>
        <div class="flex w-full max-h-[calc(100vh-4rem)]">
            <div class="grow-1 relative w-full items-stretch grid sm:grid-cols-4">
                <!-- Overlay -->
                <div v-if="isSidebarOpen" @click="closeSidebar"
                     class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 sm:hidden transition-opacity"></div>

                <!-- Sidebar -->
                <div :class="[
                    'absolute sm:relative sm:w-[100%] top-0 left-0 max-h-[calc(100vh-7rem)] w-3/4 bg-slate-900 transform transition-transform duration-300 z-50 sm:translate-x-0 overflow-y-auto',
                    isSidebarOpen ? 'translate-x-0' : '-translate-x-full'
                ]">
                    <ul v-if="chats.length > 0" class="divide-y divide-slate-700/50">
                        <li v-for="chat in chats" :key="chat.id"
                            @click="selectChat(chat.id)"
                            :class="[
                                'group px-4 py-3 cursor-pointer transition-colors',
                                'hover:bg-slate-700/30',
                                selectedChat?.id === chat.id ? 'bg-indigo-500/20 border-l-4 border-indigo-400' : ''
                            ]">
                            <div class="text-slate-200 group-hover:text-white transition-colors">
                                <span class="font-medium">{{ chat.name }}</span>
                                <p v-if="chat.lastMessage" class="text-sm mt-1 text-slate-400 line-clamp-1">
                                    {{ chat.lastMessage }}
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Main Content -->
                <div class="col-span-3 bg-slate-900 relative sm:col-span-3">
                    <!-- Mobile Header -->
                    <div class="sm:hidden p-4 border-b border-slate-700/50 bg-slate-800/50 backdrop-blur-sm">
                        <button @click="toggleSidebar" class="flex items-center space-x-2 text-slate-300 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <span class="font-medium">{{ selectedChat?.name || 'Select a chat' }}</span>
                        </button>
                    </div>

                    <!-- Chat Area -->
                    <div class="flex flex-col ">
                        <!-- Messages Container -->
                        <div class="flex-1 grow p-4 overflow-y-auto max-h-[calc(100vh-12rem)] space-y-4">
                            <template v-if="selectedChat">
                                <div v-for="message in selectedChat.messages" :key="message.id" 
                                     class="flex" :class="message.status === 'sent' ? 'justify-end' : 'justify-start'">
                                    <div :class="[
                                        'max-w-[70%] rounded-2xl p-4 transition-all',
                                        message.status === 'sent' 
                                            ? 'bg-indigo-600 text-white rounded-br-none' 
                                            : 'bg-slate-800 text-slate-200 rounded-bl-none'
                                    ]">
                                        <p class="text-sm">{{ message.Message }}</p>
                                        <div class="flex items-center justify-end mt-2 space-x-2">
                                            <span class="text-xs text-slate-400/80">{{ new Date(message.created_at).toLocaleTimeString() }}</span>
                                            <svg v-if="message.status === 'sent'" class="w-4 h-4 text-indigo-300" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <div v-else class="h-full flex items-center justify-center">
                                <p class="text-slate-400 text-lg">Select a chat to start messaging</p>
                            </div>
                        </div>

                        <!-- Input Area -->
                        <div class="p-4 border-t border-slate-700/50 bg-slate-800/30 backdrop-blur-sm">
                            <div class="flex items-center space-x-4">
                                <input type="text" placeholder="Type your message..." 
                                       class="flex-1 rounded-full border border-slate-700 bg-slate-800/50 px-6 py-3 text-slate-200 
                                              placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500
                                              transition-all duration-200"/>
                                <button class="p-3 rounded-full bg-indigo-600 hover:bg-indigo-500 text-white transition-colors
                                             focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-slate-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>