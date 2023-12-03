<script setup lang="ts">
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps<{
    to: string;
    active: boolean;
    label: string;
}>();
</script>

<template>
    <span>
        <PrimaryButton
            v-if="props.active"
            class="w-full"
            @click="router.get(props.to)">
            {{ props.label }}
        </PrimaryButton>

        <SecondaryButton
            v-else
            class="w-full border-[0.5px] border-gray-200"
            @click="router.get(props.to)">
            {{ props.label }}
        </SecondaryButton>
    </span>
</template>
