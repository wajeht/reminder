<script setup lang="ts">
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps<{
    to: string;
    label: string;
}>();
</script>

<template>
    <span>
        <PrimaryButton
            v-if="route().current() === to"
            class="w-full"
            @click="router.get(props.to)">
            {{ props.label }}
        </PrimaryButton>

        <SecondaryButton
            v-else
            class="w-full"
            @click="router.get(props.to)">
            {{ props.label }}
        </SecondaryButton>
    </span>
</template>
