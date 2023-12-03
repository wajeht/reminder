<script setup lang="ts">
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { router } from '@inertiajs/vue3';

const props = withDefaults(
    defineProps<{
        to: string;
        active: boolean;
        label: string;
        href: boolean;
    }>(),
    {
        href: false,
    },
);

function go(): void {
    if (props.href) {
        window.location.href = props.to;
    } else {
        router.get(props.to);
    }
}
</script>

<template>
    <span>
        <PrimaryButton
            v-if="props.active"
            class="w-full"
            @click="go">
            {{ props.label }}
        </PrimaryButton>

        <SecondaryButton
            v-else
            class="w-full border-[0.5px] border-gray-200"
            @click="go">
            {{ props.label }}
        </SecondaryButton>
    </span>
</template>
