<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps<{ events: Record<string, unknown>[] }>();
</script>

<template>
    <Head title="Calendar" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Calendar
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                    <pre class="p-6 text-gray-900 dark:text-gray-100">{{ props.events }}</pre>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>