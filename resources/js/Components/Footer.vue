<script setup lang="ts">
import ThemeToggle from '@/Components/ThemeToggle.vue';
import LinkWithStyle from './LinkWithStyle.vue';
</script>

<template>
    <div class="flex items-center justify-center gap-4 p-4 text-center text-xs">
        <ThemeToggle class="[&_svg]:text-xs [&_svg]:text-slate-900 [&_svg]:dark:text-slate-400" />

        <span class="text-gray-900 dark:text-gray-400">
            Copyright © 2023
            <LinkWithStyle href="/">reminder.jaw.dev</LinkWithStyle>
            . Made with ❤️ by
            <LinkWithStyle
                href="https://github.com/wajeht/reminder"
                target="_blank"
                >@wajeht ↗</LinkWithStyle
            >
        </span>
    </div>
</template>
