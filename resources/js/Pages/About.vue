<script setup lang="ts">
import ThemeToggle from '@/Components/ThemeToggle.vue';
import { Head, router } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
</script>

<template>
    <Head title="Reminder" />

    <div
        class="relative flex min-h-screen flex-col items-center justify-between bg-gray-100 dark:bg-gray-900">
        <div></div>

        <div class="flex flex-col gap-10">
            <p class="text-slate-900 dark:text-white">about</p>
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
