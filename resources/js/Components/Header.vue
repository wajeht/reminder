<script setup lang="ts">
import { Icon } from '@iconify/vue';
import NavLink from '@/Components/NavLink.vue';
</script>
<template>
    <div class="w-full p-4">
        <div class="mx-auto flex max-w-3xl justify-between">
            <div class="flex items-center justify-center gap-4">
                <NavLink
                    :href="route('app.index')"
                    :active="route().current('app.index')">
                    Home
                </NavLink>

                <NavLink
                    :href="route('app.about')"
                    :active="route().current('app.about')">
                    About
                </NavLink>

                <NavLink
                    :href="route('app.contact')"
                    :active="route().current('app.contact')">
                    Contact
                </NavLink>
            </div>

            <div class="flex items-center justify-center gap-4">
                <a
                    class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium leading-5 text-gray-500 transition duration-150 ease-in-out hover:border-gray-300 hover:text-gray-700 focus:border-gray-300 focus:text-gray-700 focus:outline-none dark:text-gray-400 dark:hover:border-gray-700 dark:hover:text-gray-300 dark:focus:border-gray-700 dark:focus:text-gray-300"
                    href="https://www.github.com/wajeht/reminder"
                    target="_blank">
                    Github
                </a>

                <NavLink
                    :href="route('login')"
                    :active="route().current('login')">
                    Login
                </NavLink>
            </div>
        </div>
    </div>
</template>
