<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import { CalendarOptions } from '@fullcalendar/core';
import interactionPlugin from '@fullcalendar/interaction';
import { Head } from '@inertiajs/vue3';
import { reactive, ref } from 'vue';
import Dialog from 'primevue/dialog';
import { OnClickOutside } from '@vueuse/components';

type Props = { events: Record<string, unknown>[] };
type States = { modal: { visible: boolean; currentEvent: Record<string, unknown> | null } };

const props = defineProps<Props>();
const states = reactive<States>({
    modal: {
        visible: false,
        currentEvent: null,
    },
});

const calendarOptions = reactive<CalendarOptions>({
    aspectRatio: 2,
    plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
    buttonText: { today: 'Today', month: 'Month', day: 'Day', week: 'Week' },
    headerToolbar: {
        left: 'title',
        end: 'timeGridDay,timeGridWeek,dayGridMonth today,prev,next',
    },
    scrollTime: '08:00',
    eventTimeFormat: {
        hour: 'numeric',
        minute: 'numeric',
        hour12: true,
    },
    views: {
        dayGridMonth: { dayMaxEventRows: 4 },
        timeGridWeek: { titleFormat: { month: 'long', day: 'numeric', separator: ' - ' } },
        timeGridDay: { titleFormat: { month: 'long', day: 'numeric' } },
    },
    dayMaxEventRows: true,
    navLinks: true,
    editable: true,
    fixedWeekCount: false,
    nowIndicator: true,
    initialView: 'dayGridMonth',
    lazyFetching: false,
    // events: props.events, // fetch here
    initialEvents: props.events,
    eventClick: function (info) {
        // prettier-ignore
        states.modal.currentEvent = props.events.find((event) => event.id === parseInt(info.event.id))!;
        states.modal.visible = true;
    },
});
</script>

<template>
    <OnClickOutside
        :options="{ ignore: ['.ignore-outside-click'] }"
        @trigger="() => ((states.modal.visible = false), (states.modal.currentEvent = null))">
        <Dialog
            v-model:visible="states.modal.visible"
            class="ignore-outside-click"
            modal
            header="Header"
            :style="{ width: '50rem' }"
            :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
            <template #header>{{ states.modal.currentEvent!.title }}</template>

            <p>{{ states.modal.currentEvent!.description }}</p>
        </Dialog>
    </OnClickOutside>

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
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <FullCalendar :options="calendarOptions"> </FullCalendar>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
