<script setup lang="ts">
import { nextTick } from 'vue';
import Dialog from 'primevue/dialog';
import { Head } from '@inertiajs/vue3';
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import { reactive, onMounted, computed } from 'vue';
import { OnClickOutside } from '@vueuse/components';
import timeGridPlugin from '@fullcalendar/timegrid';
import { CalendarOptions, EventInput } from '@fullcalendar/core';
import interactionPlugin from '@fullcalendar/interaction';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Event } from '@/types/index';

type Props = { events: Event[] };
type States = { modal: { visible: boolean; currentEvent: Event | null } };

const props = defineProps<Props>();
const states = reactive<States>({
    modal: {
        visible: false,
        currentEvent: null,
    },
});

const computedEventId = computed(() => new URLSearchParams(window.location.search).get('id'));

onMounted(async () => {
    nextTick(() => {
        states.modal.currentEvent = props.events.find(
            (event) => event.id === parseInt(computedEventId.value as string),
        )!;
        states.modal.visible = true;
    });
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
    initialEvents: props.events as unknown as EventInput[],
    eventClick: function (info) {
        // prettier-ignore
        states.modal.currentEvent = props.events.find((event) => event.id === parseInt(info.event.id))!;
        states.modal.visible = true;
    },
});

function closeModal(): void {
    states.modal.visible = false;
    states.modal.currentEvent = null;

    if (computedEventId.value) {
        const params = new URLSearchParams(window.location.search);
        params.delete('id');
        window.history.replaceState({}, document.title, window.location.pathname);
    }
}
</script>

<template>
    <OnClickOutside
        :options="{ ignore: ['.ignore-outside-click'] }"
        @trigger="closeModal">
        <Dialog
            v-if="states.modal.currentEvent"
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
        <div
            class="bg-white p-4 text-gray-900 shadow dark:bg-gray-800 dark:text-gray-100 sm:rounded-lg sm:p-8">
            <FullCalendar :options="calendarOptions"></FullCalendar>
        </div>
    </AuthenticatedLayout>
</template>
