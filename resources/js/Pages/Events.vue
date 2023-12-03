<script setup lang="ts">
import dayjs from 'dayjs';
import { Icon } from '@iconify/vue';
import Dialog from 'primevue/dialog';
import axios, { AxiosError } from 'axios';
import { reactive, computed } from 'vue';
import { useToast } from 'primevue/usetoast';
import { Head, router } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import { OnClickOutside } from '@vueuse/components';
import { Event, RecurringType } from '@/types/index';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

type Props = { events: Event[] };

type States = {
    scrolling: boolean;
    search: { modelValue: string };
    selected: { events: number[]; loading: boolean };
    menu: { currentEvent: Event | null; open: boolean };
    modal: { loading: boolean; visible: boolean; eventId: number | null };
    data: { events: Event[]; event: Event; loading: boolean; add: boolean; error: any };
};

const props = defineProps<Props>();

const states = reactive<States>({
    scrolling: false,
    search: { modelValue: '' },
    menu: { currentEvent: null, open: false },
    selected: { events: [], loading: false },
    modal: { loading: false, visible: false, eventId: null },
    data: { events: props.events, event: {} as Event, loading: false, add: false, error: {} },
});

const toast = useToast();

const computedEvents = computed(() => {
    return states.data.events.filter((event) => {
        const searchContent = event.title + ' ' + event.description;
        return searchContent.toLowerCase().includes(states.search.modelValue.toLowerCase());
    });
});

const computedSelectedEventsClass = (id: number) => {
    if (states.selected.events.includes(id)) {
        const border = 'outline outline-[1px] outline-gray-400 dark:outline-gray-500';
        return `bg-gray-50 dark:bg-gray-700 ${border}`;
    }
    return 'bg-white dark:bg-gray-800';
};

/**
 *
 * to have the search bar sticky with some my-4
 *
 */
document.addEventListener('scroll', () => {
    if (window.scrollY >= 100) {
        states.scrolling = true;
    }
});

/**
 *
 * to have the search bar sticky with some my-4
 *
 */
document.addEventListener('scroll', () => {
    if (window.scrollY <= 100) {
        states.scrolling = false;
    }
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
        states.data.events = states.data.events.filter((event) => event.id !== id);
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

async function deleteAllEvents(): Promise<void> {
    try {
        const deletePromises = states.selected.events.map(async function (id) {
            await axios.delete(`/api/v1/events/${id}`);
        });

        const results = await Promise.allSettled(deletePromises);

        let deletionErrors = false;

        for (const result of results) {
            if (result.status === 'rejected') {
                deletionErrors = true;
            }
        }

        states.data.events = states.data.events.filter(
            (event) => !states.selected.events.includes(event.id),
        );

        states.selected.events = [];

        if (deletionErrors) {
            toast.add({
                severity: 'warn',
                detail: 'Some events could not be deleted.',
                life: 3000,
            });
        } else {
            toast.add({
                severity: 'success',
                detail: 'All selected events deleted successfully!',
                life: 3000,
            });
        }
    } catch (error) {
        toast.add({
            severity: 'error',
            detail: 'Oops, something went wrong!',
            life: 3000,
        });
    } finally {
        //
    }
}

async function createEvent(): Promise<void> {
    try {
        await axios.post('/api/v1/events', {
            ...states.data.event,
        });
    } catch (error) {
        if (error instanceof AxiosError && error.response?.status == 422) {
            states.data.error = error.response?.data?.errors;
            toast.add({
                severity: 'error',
                detail: error.response?.data?.message,
                life: 3000,
            });
        } else {
            toast.add({
                severity: 'error',
                detail: 'Oops, something went wrong!',
                life: 3000,
            });
        }
    } finally {
        //
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
    if (states.selected.events.includes(id)) {
        states.selected.events = states.selected.events.filter((sid) => sid !== id);
    } else {
        states.selected.events.push(id);
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
    <Head title="Events" />

    <!-- add modal -->
    <OnClickOutside
        :options="{ ignore: ['.ignore-outside-click'] }"
        @trigger="() => (states.data.add = false)">
        <Dialog
            v-model:visible="states.data.add"
            class="ignore-outside-click"
            modal
            header="Add"
            :style="{ width: 'calc(100vw - 75%)' }"
            :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
            <div class="flex flex-col gap-6">
                <!-- title -->
                <div>
                    <InputLabel
                        for="title"
                        value="Title" />

                    <TextInput
                        id="title"
                        v-model="states.data.event.title"
                        type="text"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="title" />

                    <InputError
                        v-if="states.data.error?.title"
                        class="mt-2"
                        :message="states.data.error?.title[0]" />
                </div>

                <!-- description -->
                <div>
                    <InputLabel
                        for="description"
                        value="Description" />

                    <TextInput
                        id="description"
                        v-model="states.data.event.description"
                        type="text"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="description" />
                </div>

                <!-- start date -->
                <div>
                    <InputLabel
                        for="start_date"
                        value="Start Date" />

                    <TextInput
                        id="start_date"
                        v-model="states.data.event.start_date"
                        type="date"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="start_date" />

                    <InputError
                        v-if="states.data.error.start_date"
                        class="mt-2"
                        :message="states.data.error?.start_date[0]" />
                </div>

                <!-- start date -->
                <div>
                    <InputLabel
                        for="end_date"
                        value="End Date" />

                    <TextInput
                        id="end_date"
                        v-model="states.data.event.end_date"
                        type="date"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="end_date" />
                </div>

                <!-- color  -->
                <div>
                    <InputLabel
                        for="color"
                        value="Color" />

                    <TextInput
                        id="color"
                        v-model="states.data.event.color"
                        type="color"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="color" />
                </div>
            </div>

            <template #footer>
                <div class="flex gap-2">
                    <SecondaryButton
                        :disabled="states.data.loading"
                        @click="() => (states.data.add = false)">
                        Cancel
                    </SecondaryButton>

                    <PrimaryButton
                        :disabled="states.data.loading"
                        @click="createEvent">
                        Add
                    </PrimaryButton>
                </div>
            </template>
        </Dialog>
    </OnClickOutside>

    <!-- delete confirmation modal -->
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

    <AuthenticatedLayout>
        <div class="flex flex-col gap-4">
            <!-- events header -->
            <div
                class="sticky top-0 z-20 bg-gray-100 dark:bg-gray-900"
                :class="{ 'z-20 -mx-3 px-3': states.scrolling }">
                <div
                    :class="{ 'z-20 my-4': states.scrolling }"
                    class="bg-white p-4 text-gray-900 shadow dark:bg-gray-800 dark:text-gray-100 sm:rounded-lg sm:p-8">
                    <div class="flex max-h-[33px] gap-4">
                        <!-- clear selected events -->
                        <PrimaryButton
                            v-if="states.selected.events.length > 1"
                            style="padding-left: 6px !important; padding-right: 6px !important"
                            @click="() => (states.selected.events = [])"
                            ><Icon
                                icon="bi:x"
                                class="text-xl"
                        /></PrimaryButton>

                        <!-- search input -->
                        <div class="relative h-fit w-full">
                            <TextInput
                                id="text"
                                v-model="states.search.modelValue"
                                placeholder="Search..."
                                type="text"
                                class="max-h-[33px] w-full" />

                            <button
                                v-if="states.search.modelValue.length"
                                class="absolute inset-y-0 right-0 mr-4"
                                @click="() => (states.search.modelValue = '')">
                                <Icon icon="bi:x" />
                            </button>
                        </div>

                        <!-- buttons -->
                        <div class="inline-flex w-fit gap-2">
                            <PrimaryButton @click="() => (states.data.add = true)"
                                >Add</PrimaryButton
                            >

                            <PrimaryButton>Filters</PrimaryButton>

                            <div
                                v-if="states.selected.events.length"
                                class="relative">
                                <div
                                    v-if="states.selected.events.length > 1"
                                    class="dark:gray-200 absolute -right-[2px] -top-[2px] flex h-3 w-3 items-center justify-center rounded-full border-[1px] border-gray-200 bg-white p-2 text-xs shadow-md dark:text-gray-800">
                                    {{ states.selected.events.length }}
                                </div>

                                <DangerButton
                                    style="text-wrap: nowrap !important"
                                    @click="deleteAllEvents">
                                    <span v-if="states.selected.events.length > 1">Delete All</span>

                                    <span v-else>Delete</span>
                                </DangerButton>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- if there are events -->
            <template v-if="computedEvents.length">
                <div
                    v-for="(event, idx) in computedEvents"
                    :key="idx"
                    :style="event.color ? `border-left: 4px solid ${event.color}` : ''"
                    :class="[computedSelectedEventsClass(event.id)]"
                    class="flex gap-4 p-4 text-gray-900 shadow hover:bg-gray-50 dark:text-gray-100 dark:hover:bg-gray-700 sm:rounded-lg sm:p-8"
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

                    <!-- left -->
                    <div class="flex-1">
                        <div class="flex h-full flex-col justify-between gap-1">
                            <!-- title -->
                            <span class="font-semibold">{{ event.title }}</span>

                            <!-- description -->
                            <div class="flex flex-col gap-2">
                                <span
                                    v-if="event.description"
                                    class="text-sm text-gray-500"
                                    >{{ event.description }}</span
                                >

                                <!-- bottom -->
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

                    <!-- center -->
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

                    <!-- right -->
                    <div class="relative flex-none">
                        <!-- 3 dots -->
                        <button
                            class="ignore-outside-click rounded-sm p-1 text-sm hover:bg-gray-100 hover:dark:bg-gray-800"
                            @click="toggleEventAction(event.id)">
                            <Icon
                                icon="heroicons:ellipsis-vertical-20-solid"
                                class="items-start text-lg font-semibold text-gray-900 dark:text-gray-100" />
                        </button>

                        <!-- menu list -->
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
