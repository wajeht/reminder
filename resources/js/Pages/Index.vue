<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
</script>

<template>
    <GuestLayout>
        <Head title="Reminder" />

        <div class="flex flex-col gap-10">
            <div class="flex flex-col gap-3">
                <div class="flex items-center justify-center gap-2">
                    <span class="text-4xl"> 🔔 </span>

                    <h1 class="text-5xl font-[900] tracking-tight text-gray-900 dark:text-gray-100">
                        Reminder
                    </h1>
                </div>

                <p class="text-gray-900 dark:text-gray-100">
                    schedule and track automatic countdowns for important events
                </p>
            </div>

            <div class="flex justify-center gap-2">
                <SecondaryButton @click="router.get('about')"> Learn more </SecondaryButton>

                <PrimaryButton @click="router.get('login')"> Get started </PrimaryButton>
            </div>
        </div>
    </GuestLayout>
</template>
