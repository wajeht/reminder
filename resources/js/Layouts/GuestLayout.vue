<script setup lang="ts">
import Footer from '@/Components/Footer.vue';
import Header from '@/Components/Header.vue';
</script>

<template>
    <div
        class="relative flex min-h-screen flex-col items-center justify-between bg-gray-100 dark:bg-gray-900">
        <Header />

        <div class="mt-6 flex h-full w-full items-center justify-center overflow-hidden p-5">
            <slot />
        </div>

        <Footer />
    </div>
</template>
