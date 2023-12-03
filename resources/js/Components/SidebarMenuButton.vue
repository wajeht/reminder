<script setup lang="ts">
import { Icon } from '@iconify/vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { router } from '@inertiajs/vue3';

const props = withDefaults(
    defineProps<{
        to: string;
        active: boolean;
        label: string;
        href?: boolean;
    }>(),
    {
        href: false,
    },
);

function go(): void {
    if (props.href) {
        window.location.href = props.to;
    } else {
        router.visit(props.to, {
            preserveScroll: true,
        });
    }
}
</script>

<template>
    <span>
        <PrimaryButton
            v-if="props.active"
            class="w-full"
            @click="go">
            <div class="flex w-full items-center justify-between text-right">
                <div class="flex items-center gap-3">
                    <slot />
                    {{ props.label }}
                </div>

                <Icon
                    icon="bi:chevron-right"
                    class="text-gray-400" />
            </div>
        </PrimaryButton>

        <SecondaryButton
            v-else
            class="w-full border-[0.5px] border-gray-200"
            @click="go">
            <div class="flex w-full items-center justify-between text-right">
                <div class="flex items-center gap-3">
                    <slot />
                    {{ props.label }}
                </div>

                <Icon
                    icon="bi:chevron-right"
                    class="text-gray-300" />
            </div>
        </SecondaryButton>
    </span>
</template>
