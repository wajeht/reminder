<script setup lang="ts">
import ThemeToggle from '@/Components/ThemeToggle.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex items-center justify-center gap-4 p-4 text-center text-xs">
        <ThemeToggle class="[&_svg]:text-xs [&_svg]:text-slate-900 [&_svg]:dark:text-slate-400" />

        <span class="text-slate-900 dark:text-slate-400">
            Copyright © 2023
            <Link
                :href="route('app.index')"
                class="hover:underline dark:hover:text-white">
                reminder.jaw.dev
            </Link>
            . Made with ❤️ by
            <a
                class="hover:underline dark:hover:text-white"
                href="https://github.com/wajeht/reminder"
                target="_blank"
                title="reminder github repo"
                >@wajeht ↗️</a
            >
        </span>
    </div>
</template>
