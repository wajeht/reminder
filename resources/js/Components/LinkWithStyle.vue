<script setup lang="ts">
const props = withDefaults(
    defineProps<{
        href: string;
        target?: '_blank' | '_self' | '_self' | '_top';
    }>(),
    {
        target: '_self',
    },
);
</script>

<template>
    <a
        :href="props.href"
        :target="props.target"
        class="border-b-[1px] border-transparent text-gray-900 transition duration-150 ease-in-out hover:border-indigo-400 hover:text-gray-950 focus:border-indigo-700 focus:outline-none dark:text-gray-400 dark:hover:border-indigo-600 dark:hover:text-gray-300">
        <slot />
    </a>
</template>
