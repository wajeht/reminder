<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Card from '@/Components/Card.vue';
</script>

<template>
    <GuestLayout>
        <Head title="About" />

        <Card class="flex flex-col gap-4 text-gray-900 dark:text-gray-100">
            <h2
                class="text-center text-2xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                About
            </h2>

            <span class="text-gray-900 dark:text-gray-100">
                schedule and track automatic countdowns for important events
            </span>
        </Card>
    </GuestLayout>
</template>
