<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import LinkWithStyle from '@/Components/LinkWithStyle.vue';
import Card from '@/Components/Card.vue';
</script>

<template>
    <GuestLayout>
        <Head title="Privacy" />

        <Card class="flex flex-col gap-4 text-gray-900 dark:text-gray-100">
            <h2
                class="text-center text-2xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Privacy
            </h2>

            <span class="text-gray-900 dark:text-gray-100">
                If you care about privacy, you can view the project's source code below.
            </span>

            <div>
                <LinkWithStyle
                    href="https://github.com/wajeht/reminder"
                    target="_blank">
                    https://github.com/wajeht/reminder ↗
                </LinkWithStyle>
            </div>
        </Card>
    </GuestLayout>
</template>
