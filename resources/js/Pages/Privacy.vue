<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
</script>

<template>
    <GuestLayout>
        <Head title="Privacy" />

        <div class="flex flex-col gap-10">
            <div class="flex flex-col gap-3">
                <h1
                    class="text-center text-8xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-5xl lg:text-6xl">
                    Privacy
                </h1>
            </div>
        </div>
    </GuestLayout>
</template>
