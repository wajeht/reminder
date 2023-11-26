<script setup lang="ts">
import { Icon } from '@iconify/vue';
import { useDark, useToggle, useStorage } from '@vueuse/core';
import { watch } from 'vue';

const isDark = useDark();
const savedTheme = useStorage('reminder-saved-theme', false);

const toggleDark = useToggle(isDark);

watch(
    () => isDark.value,
    () => {
        savedTheme.value = isDark.value;
    },
);
</script>
<template>
    <button
        class="text-[10px]"
        @click="() => toggleDark()">
        <Icon
            v-if="isDark"
            class="text-[#9da3ae]"
            icon="bi:sun-fill" />

        <Icon
            v-else
            class="text-[#6c727f]"
            icon="bi:moon-fill" />
    </button>
</template>
