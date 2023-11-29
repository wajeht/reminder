<script setup lang="ts">
import { Icon } from '@iconify/vue';
import dayjs from 'dayjs';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { OnClickOutside } from '@vueuse/components';

type Props = { events: Record<string, any>[] };
type States = { menu: { currentEvent: Record<string, any> | null; open: boolean } };

const props = defineProps<Props>();
const states = reactive<States>({
    menu: {
        currentEvent: {},
        open: false,
    },
});

function formatDate(date: string | Date): string {
    return dayjs(date).format('MM/DD/YYYY h:mm:s A');
}

function toggleEventAction(id: string, forceClose = false): void {
    if (forceClose === true) {
        states.menu.open = false;
        states.menu.currentEvent = null;
        return;
    }

    states.menu.open = !states.menu.open;

    if (states.menu.open) {
        states.menu.currentEvent = props.events.find((event) => event.id === parseInt(id))!;
    } else {
        states.menu.currentEvent = null;
    }
}
</script>

<template>
    <Head title="Home" />

    <AuthenticatedLayout>
        <div class="mx-auto flex max-w-7xl flex-col gap-4 py-12 sm:flex-row sm:px-6 lg:px-8">
            <!-- menu -->
            <div
                class="flex w-full flex-col gap-2 overflow-hidden bg-white p-4 text-gray-900 shadow dark:bg-gray-800 dark:text-gray-100 sm:w-[30%] sm:rounded-lg sm:p-8 h-fit">
                <div class="w-full rounded bg-red-200 px-4 py-2">Events</div>

                <div class="w-full rounded bg-red-200 px-4 py-2">Settings</div>
            </div>

            <!-- cards -->
            <div class="flex w-full flex-col gap-4 sm:w-[70%]">
                <div
                    v-for="(event, idx) in props.events"
                    :key="idx"
                    :style="event.color ? `border-left: 4px solid ${event.color}` : ''"
                    class="flex gap-4 bg-white p-4 text-gray-900 shadow dark:bg-gray-800 dark:text-gray-100 sm:rounded-lg sm:p-8">
                    <div
                        v-if="event.logo_url"
                        class="flex-none">
                        <div class="max-w-[50px]">
                            <img
                                class="rounded-md"
                                :src="`storage/${event!.logo_url}`! as string"
                                alt="logo_url" />
                        </div>
                    </div>

                    <div class="flex-1">
                        <div class="flex h-full flex-col justify-between gap-1">
                            <span class="font-semibold">{{ event.title }}</span>

                            <div class="flex flex-col gap-2">
                                <span
                                    v-if="event.description"
                                    class="text-sm text-gray-500"
                                    >{{ event.description }}</span
                                >

                                <div class="flex items-center gap-2">
                                    <div class="flex items-center gap-1 text-xs text-gray-500">
                                        <Icon icon="heroicons:calendar-days" />

                                        <span
                                            >Start: {{ formatDate(event.start_date as Date) }}</span
                                        >
                                    </div>

                                    <div
                                        v-if="event.end_date"
                                        class="flex items-center gap-1 text-xs text-gray-500">
                                        <Icon icon="heroicons:calendar-days" />

                                        <span>End: {{ formatDate(event.end_date as Date) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-none text-right">
                        <div class="flex h-full flex-col justify-between gap-1">
                            <div class="flex items-center justify-end gap-1">
                                <span class="font-medium">{{ event.count_down }}</span>

                                <span class="tex-xs text-gray-500">left</span>
                            </div>

                            <div
                                class="flex items-center justify-center gap-1 text-xs text-gray-500">
                                <span>Repeat {{ event.recurrence_type }}</span>

                                <Icon icon="heroicons:arrow-path" />
                            </div>
                        </div>
                    </div>

                    <div class="relative flex-none">
                        <button
                            class="ignore-outside-click rounded-sm p-1 text-sm hover:bg-gray-100 hover:dark:bg-gray-700"
                            @click="toggleEventAction(event.id)">
                            <Icon
                                icon="heroicons:ellipsis-vertical-20-solid"
                                class="items-start text-lg font-semibold text-gray-900 dark:text-gray-100" />
                        </button>

                        <OnClickOutside
                            :options="{ ignore: ['.ignore-outside-click'] }"
                            @trigger="toggleEventAction(event.id, true)">
                            <div
                                v-if="states.menu.open && event.id === states.menu.currentEvent?.id"
                                class="absolute right-0 z-10 mt-1 w-[192px] rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 dark:bg-gray-700">
                                <div class="flex h-full w-full flex-col">
                                    <span
                                        class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-gray-300 dark:hover:bg-gray-800 dark:focus:bg-gray-800"
                                        >Edit</span
                                    >

                                    <span
                                        class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-gray-300 dark:hover:bg-gray-800 dark:focus:bg-gray-800"
                                        >Calendar</span
                                    >

                                    <span
                                        class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-gray-300 dark:hover:bg-gray-800 dark:focus:bg-gray-800"
                                        >Delete</span
                                    >
                                </div>
                            </div>
                        </OnClickOutside>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
