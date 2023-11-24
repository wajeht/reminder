<script setup lang="ts">
import ThemeToggle from '@/Components/ThemeToggle.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Reminder" />

    <div
        class="relative flex min-h-screen flex-col items-center justify-between bg-gray-100 dark:bg-gray-900">
        <div></div>

        <div class="flex flex-col gap-3">
            <h1
                class="text-center text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-5xl lg:text-6xl">
                reminder
            </h1>

            <p class="text-slate-900 dark:text-white">
                schedule and track automatic countdowns for important events
            </p>
        </div>

        <div class="flex items-center justify-center gap-4 p-4">
            <ThemeToggle class="[&_svg]:text-slate-900 [&_svg]:dark:text-slate-400" />

            <span class="text-sm text-slate-900 dark:text-slate-400">
                Copyright © 2023. Made with ❤️ by
                <a
                    class="hover:underline dark:hover:text-white"
                    href="https://github.com/wajeht/reminder"
                    target="_blank"
                    title="reminder github repo"
                    >@wajeht ↗️</a
                >
            </span>
        </div>
    </div>
</template>
