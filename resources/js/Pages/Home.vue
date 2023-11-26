<script setup lang="ts">
import dayjs from 'dayjs';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

type Props = { events: Record<string, unknown>[] };
const props = defineProps<Props>();

function formatDate(date: string | Date) {
    return dayjs(date).format('MM/DD/YYYY');
}
</script>

<template>
    <Head title="Home" />

    <AuthenticatedLayout>
        <div class="mx-auto grid max-w-7xl grid-cols-4 gap-4 py-12 sm:px-6 lg:px-8">
            <div
                class="flex flex-col overflow-hidden bg-white p-6 text-gray-900 shadow-sm dark:bg-gray-800 dark:text-gray-100 sm:rounded-lg"></div>

            <div class="col-span-3 flex flex-col gap-4">
                <div
                    v-for="(event, idx) in props.events"
                    :key="idx"
                    class="flex gap-4 bg-white p-6 text-gray-900 shadow-sm dark:bg-gray-800 dark:text-gray-100 sm:rounded-lg">
                    <div class="flex-none">
                        <div>
                            <img
                                :src="event!.logo_url! as string"
                                alt="logo_url" />
                        </div>
                    </div>

                    <div class="flex-1">
                        <div class="flex h-full flex-col gap-1">
                            <span>{{ event.title }}</span>

                            <span class="text-sm text-gray-500">{{ event.description }}</span>
                        </div>
                    </div>

                    <div class="flex-none text-right">
                        <div class="flex h-full flex-col justify-between gap-1">
                            <span>{{ event.count_down }}</span>

                            <span class="text-sm text-gray-500">{{
                                formatDate(event.end_date as Date)
                            }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
