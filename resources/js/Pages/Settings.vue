<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
    <Head title="Settings" />

    <AuthenticatedLayout>
        <div
            class="flex items-center justify-center gap-4 bg-white p-4 font-light text-gray-600 shadow dark:bg-gray-800 dark:text-gray-400 sm:rounded-lg sm:p-8">
            Settings
        </div>
    </AuthenticatedLayout>
</template>
