<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Chats" />

    <AuthenticatedLayout>
        <div class="grid grid-cols-4 h-screen">
            <!-- Sidebar -->
            <div class="h-screen flex flex-col p-4 justify-content-start bg-slate-900">
                <PrimaryButton class="ms-4"> A Button</PrimaryButton>
                <PrimaryButton class="ms-4"> A Button</PrimaryButton>
                <PrimaryButton class="ms-4"> A Button</PrimaryButton>
            </div>

            <!-- Main Content -->
            <div class=" h-screen col-span-3 p-4 bg-slate-600">
                <!-- Main content -->
                <PrimaryButton class="ms-4"> A Button</PrimaryButton>
                <PrimaryButton class="ms-4"> A Button</PrimaryButton>
                <PrimaryButton class="ms-4"> A Button</PrimaryButton>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
