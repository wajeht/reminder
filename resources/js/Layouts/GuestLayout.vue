<script setup lang="ts">
import ThemeToggle from '@/Components/ThemeToggle.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <div
        class="relative flex min-h-screen flex-col items-center justify-between bg-gray-100 dark:bg-gray-900">
        <div></div>

        <div class=" flex w-full flex-col items-center justify-center">
            <Link href="/">
                <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
            </Link>

            <div
                class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md dark:bg-gray-800 sm:max-w-md sm:rounded-lg">
                <slot />
            </div>
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
