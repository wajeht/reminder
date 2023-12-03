<script setup lang="ts">
import axios from 'axios';
import dayjs from 'dayjs';
import { Icon } from '@iconify/vue';
import { Head, router } from '@inertiajs/vue3';
import { OnClickOutside } from '@vueuse/components';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Event } from '@/types/index';
import Dialog from 'primevue/dialog';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useToast } from 'primevue/usetoast';
import TextInput from '@/Components/TextInput.vue';
import { reactive, computed } from 'vue';
import DangerButton from '@/Components/DangerButton.vue';

type Props = { events: Event[] };
type States = {
    events: Event[];
    selectedEvents: number[];
    menu: { currentEvent: Event | null; open: boolean };
    modal: { loading: boolean; visible: boolean; eventId: number | null };
    search: { modelValue: string };
};

const props = defineProps<Props>();

const states = reactive<States>({
    selectedEvents: [],
    events: props.events,
    menu: {
        currentEvent: null,
        open: false,
    },
    modal: {
        loading: false,
        visible: false,
        eventId: null,
    },
    search: {
        modelValue: '',
    },
});

const toast = useToast();

const computedEvents = computed(() => {
    return states.events.filter((event) => {
        const searchContent = event.title + ' ' + event.description;
        return searchContent.toLowerCase().includes(states.search.modelValue.toLowerCase());
    });
});

function viewEvent(id: number): void {
    router.visit(route('calendar', { id }));
}

function editEvent(id: number): void {
    alert(`id: ${id} editEvent() has not been implemented yet!`);
}

async function deleteEvent(id: number): Promise<void> {
    try {
        states.modal.loading = true;
        await axios.delete(`/api/v1/events/${id}`);
        // router.reload({ only: ['events'] });
        states.events = states.events.filter((event) => event.id !== id);
        closeConfirmDeletionModal();
        states.modal.eventId = -1;
        toast.add({
            severity: 'success',
            detail: 'Deleted!',
            life: 3000,
        });
    } catch (error) {
        toast.add({
            severity: 'error',
            detail: 'Oops, something went wrong!',
            life: 3000,
        });
    } finally {
        states.modal.loading = false;
    }
}

function formatDate(date: string | Date): string {
    return dayjs(date).format('MM/DD/YYYY h:mm:s A');
}

function toggleEventAction(id: number, forceClose = false): void {
    if (forceClose === true) {
        states.menu.open = false;
        states.menu.currentEvent = null;
        return;
    }

    states.menu.open = !states.menu.open;

    if (states.menu.open) {
        states.menu.currentEvent = props.events.find((event) => event.id === id)!;
    } else {
        states.menu.currentEvent = null;
    }
}

function selectEvent(id: number): void {
    if (states.selectedEvents.includes(id)) {
        states.selectedEvents = states.selectedEvents.filter((sid) => sid !== id);
    } else {
        states.selectedEvents.push(id);
    }
}

function openConfirmDeletionModal(id: number): void {
    states.modal.visible = true;
    states.modal.eventId = id;
}

function closeConfirmDeletionModal(): void {
    states.modal.visible = false;
    states.modal.eventId = -1;
}
</script>

<template>
    <OnClickOutside
        :options="{ ignore: ['.ignore-outside-click'] }"
        @trigger="closeConfirmDeletionModal">
        <Dialog
            v-if="states.modal.eventId"
            v-model:visible="states.modal.visible"
            class="ignore-outside-click"
            modal
            header="Warning"
            :style="{ width: 'calc(100vw - 75%)' }"
            :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
            <span class="text-sm">Are you sure you want to delete this event?</span>

            <template #footer>
                <div class="flex gap-2">
                    <SecondaryButton
                        :disabled="states.modal.loading"
                        @click="closeConfirmDeletionModal">
                        Cancel
                    </SecondaryButton>

                    <PrimaryButton
                        :disabled="states.modal.loading"
                        @click="deleteEvent(states.modal.eventId)">
                        Delete
                    </PrimaryButton>
                </div>
            </template>
        </Dialog>
    </OnClickOutside>

    <Head title="Event" />

    <AuthenticatedLayout>
        <div class="flex flex-col gap-4">
            <!-- events header -->
            <div
                class="sticky top-4 z-50 bg-white p-4 text-gray-900 shadow dark:bg-gray-800 dark:text-gray-100 sm:rounded-lg sm:p-8">
                <div class="flex max-h-[33px] gap-4">
                    <TextInput
                        id="text"
                        v-model="states.search.modelValue"
                        placeholder="Search..."
                        type="text"
                        class="w-full" />

                    <div class="inline-flex w-fit gap-2">
                        <PrimaryButton>Add</PrimaryButton>

                        <PrimaryButton>Filters</PrimaryButton>

                        <div
                            v-if="states.selectedEvents.length"
                            class="relative">
                            <div
                                class="dark:gray-200 absolute -right-[2px] -top-[2px] flex h-3 w-3 items-center justify-center rounded-full border-[1px] border-gray-200 bg-white p-2 text-xs shadow-md dark:text-gray-800">
                                {{ states.selectedEvents.length }}
                            </div>

                            <DangerButton style="text-wrap: nowrap !important"
                                >Delete All</DangerButton
                            >
                        </div>
                    </div>
                </div>
            </div>

            <!-- events -->
            <template v-if="computedEvents.length">
                <div
                    v-for="(event, idx) in computedEvents"
                    :key="idx"
                    :style="event.color ? `border-left: 4px solid ${event.color}` : ''"
                    class="flex gap-4 bg-white p-4 text-gray-900 shadow dark:bg-gray-800 dark:text-gray-100 sm:rounded-lg sm:p-8"
                    @click="selectEvent(event.id)">
                    <div
                        v-if="event.logo_url"
                        class="flex-none">
                        <div class="max-w-[50px]">
                            <img
                                class="rounded-md"
                                :src="`storage/${event!.logo_url}`"
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
                                    <button
                                        class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-gray-300 dark:hover:bg-gray-800 dark:focus:bg-gray-800"
                                        @click="editEvent(event.id)">
                                        Edit
                                    </button>

                                    <button
                                        class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-gray-300 dark:hover:bg-gray-800 dark:focus:bg-gray-800"
                                        @click="viewEvent(event.id)">
                                        Calendar
                                    </button>

                                    <button
                                        class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-gray-300 dark:hover:bg-gray-800 dark:focus:bg-gray-800"
                                        @click="openConfirmDeletionModal(event.id)">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </OnClickOutside>
                    </div>
                </div>
            </template>

            <!-- if empty -->
            <div
                v-else
                class="flex items-center justify-center gap-4 bg-white p-4 font-light text-gray-600 shadow dark:bg-gray-800 dark:text-gray-400 sm:rounded-lg sm:p-8">
                There are no events currently.
            </div>
        </div>
    </AuthenticatedLayout>
</template>
