<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import { CalendarOptions } from '@fullcalendar/core';
import interactionPlugin from '@fullcalendar/interaction';
import { Head } from '@inertiajs/vue3';
import { reactive } from 'vue';

const props = defineProps<{ events: Record<string, unknown>[] }>();

const calendarOptions = reactive<CalendarOptions>({
    aspectRatio: 2,
    plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
    buttonText: { today: 'Today', month: 'Month', day: 'Day', week: 'Week' },
    headerToolbar: {
        left: 'title',
        end: 'timeGridWeek,dayGridMonth today,prev,next',
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
    fixedWeekCount: false,
    nowIndicator: true,
    initialView: 'dayGridMonth',
    lazyFetching: false,
    events: props.events,
});
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
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <FullCalendar :options="calendarOptions"> </FullCalendar>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
