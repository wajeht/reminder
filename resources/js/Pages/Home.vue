<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

type Props = { events: Record<string, unknown>[] };
const props = defineProps<Props>();
</script>

<template>
    <Head title="Home" />

    <AuthenticatedLayout>
        <div class="mx-auto grid max-w-7xl grid-cols-4 gap-4 py-12 sm:px-6 lg:px-8">
            <div
                class="flex flex-col overflow-hidden bg-white p-6 text-gray-900 shadow-sm dark:bg-gray-800 dark:text-gray-100 sm:rounded-lg"></div>

            <div class="col-span-3 flex flex-col gap-4">
                <div
                    v-for="event in props.events"
                    :key="event.id"
                    class="flex flex-col overflow-hidden bg-white p-6 text-gray-900 shadow-sm dark:bg-gray-800 dark:text-gray-100 sm:rounded-lg">
                    <span>{{ event.title }}</span>

                    <span class="text-sm text-gray-500">{{ event.description }}</span>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
