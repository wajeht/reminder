<script setup lang="ts">
import { onMounted } from 'vue';
import { Icon } from '@iconify/vue';
import { useDark, useToggle } from '@vueuse/core';

const isDark = useDark();
const toggleDark = useToggle(isDark);

onMounted(() => (isDark.value = true));
</script>
<template>
    <button
        class="text-sm"
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
