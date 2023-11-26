<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Card from '@/Components/Card.vue';
</script>

<template>
    <GuestLayout>
        <Head title="Terms" />

        <Card class="flex flex-col gap-4 text-gray-900 dark:text-gray-100">
            <h2
                class="text-center text-2xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Terms
            </h2>

            <h5>MIT License</h5>

            <h5>Copyright (c) 2023 wajeht</h5>

            <p>
                Permission is hereby granted, free of charge, to any person obtaining a copy of this
                software and associated documentation files (the "Software"), to deal in the
                Software without restriction, including without limitation the rights to use, copy,
                modify, merge, publish, distribute, sublicense, and/or sell copies of the Software,
                and to permit persons to whom the Software is furnished to do so, subject to the
                following conditions:
            </p>

            <p>
                The above copyright notice and this permission notice shall be included in all
                copies or substantial portions of the Software.
            </p>

            <p>
                THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
                INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A
                PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
                HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
                CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE
                OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
            </p>
        </Card>
    </GuestLayout>
</template>
