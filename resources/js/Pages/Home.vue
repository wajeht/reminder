<script setup lang="ts">
import { Icon } from '@iconify/vue';
import dayjs from 'dayjs';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { OnClickOutside } from '@vueuse/components';

type Props = { events: Record<string, any>[] };
const props = defineProps<Props>();

type States = { menu: { currentEvent: Record<string, any> | null; open: boolean } };

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
        <div class="mx-auto grid max-w-7xl grid-cols-4 gap-4 py-12 sm:px-6 lg:px-8">
            <div
                class="flex flex-col overflow-hidden bg-white p-6 text-gray-900 shadow-sm dark:bg-gray-800 dark:text-gray-100 sm:rounded-lg"></div>

            <div class="col-span-3 flex flex-col gap-4">
                <div
                    v-for="(event, idx) in props.events"
                    :key="idx"
                    :style="event.color ? `border-left: 4px solid ${event.color}` : ''"
                    class="flex gap-4 bg-white p-6 text-gray-900 shadow-sm dark:bg-gray-800 dark:text-gray-100 sm:rounded-lg">
                    <div
                        v-if="event.logo_url"
                        class="flex-none">
                        <div class="max-w-[50px]">
                            <img
                                :src="`storage/${event!.logo_url}`! as string"
                                alt="logo_url" />
                        </div>
                    </div>

                    <div class="flex-1">
                        <div class="flex h-full flex-col justify-center gap-1">
                            <span class="font-semibold">{{ event.title }}</span>
                            <span
                                v-if="event.description"
                                class="text-sm text-gray-500"
                                >{{ event.description }}</span
                            >
                        </div>
                    </div>

                    <div class="flex-none text-right">
                        <div class="flex h-full flex-col justify-between gap-1">
                            <span class="font-medium">{{ event.count_down }}</span>
                            <span class="text-xs text-gray-500">{{
                                formatDate(event.end_date as Date)
                            }}</span>
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
