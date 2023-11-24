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
                <h1
                    class="text-center text-8xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-5xl lg:text-6xl">
                    reminder
                </h1>

                <p class="text-slate-900 dark:text-white">
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
