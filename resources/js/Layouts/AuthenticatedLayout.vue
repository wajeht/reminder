<script setup lang="ts">
import { ref } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import { Icon } from '@iconify/vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link, router } from '@inertiajs/vue3';
import ThemeToggle from '@/Components/ThemeToggle.vue';
import Toast from 'primevue/toast';
import SidebarMenuButton from '@/Components/SidebarMenuButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import axios from 'axios';

const showingNavigationDropdown = ref(false);

const loggingOut = ref(false);

async function logout(): Promise<void> {
    try {
        loggingOut.value = true;
        await axios.post(route('logout'));
        loggingOut.value = true;
        router.get(route('public.index'));
    } catch (_error) {
        console.log(_error);
    }
}
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <nav class="bg-white shadow-sm dark:bg-gray-800">
                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex shrink-0 items-center">
                                <Link :href="route('home')">
                                    <div class="flex items-center justify-center gap-2 text-2xl">
                                        <span> 🔔 </span>

                                        <h1
                                            class="font-[900] tracking-tight text-gray-900 dark:text-gray-100">
                                            Reminder
                                        </h1>
                                    </div>
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <!-- <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <NavLink
                                    :href="route('home')"
                                    :active="route().current('home')">
                                    Home
                                </NavLink>

                                <NavLink
                                    :href="route('calendar')"
                                    :active="route().current('calendar')">
                                    Calendar
                                </NavLink>

                                <a
                                    v-if="$page.props.auth.user.is_admin"
                                    class="ease-in-out' inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium leading-5 text-gray-500 transition duration-150 hover:border-gray-300 hover:text-gray-700 focus:border-gray-300 focus:text-gray-700 focus:outline-none dark:text-gray-400 dark:hover:border-gray-700 dark:hover:text-gray-300 dark:focus:border-gray-700 dark:focus:text-gray-300"
                                    :href="route('filament.admin.pages.dashboard')">
                                    Admin
                                </a>
                            </div> -->
                        </div>

                        <div class="hidden sm:ms-6 sm:flex sm:items-center">
                            <ThemeToggle class="[&_svg]:text-xs" />

                            <!-- Settings Dropdown -->
                            <div class="relative ms-3">
                                <Dropdown
                                    align="right"
                                    width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300">
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="-me-0.5 ms-2 size-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')">
                                            Profile
                                        </DropdownLink>

                                        <DropdownLink :href="route('settings')">
                                            Settings
                                        </DropdownLink>

                                        <DropdownLink
                                            :href="route('logout')"
                                            method="post"
                                            as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <ThemeToggle class="mr-3 [&_svg]:text-xs" />

                            <button
                                class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:bg-gray-900 dark:hover:text-gray-400 dark:focus:bg-gray-900 dark:focus:text-gray-400"
                                @click="showingNavigationDropdown = !showingNavigationDropdown">
                                <svg
                                    class="size-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />

                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden">
                    <div class="space-y-1 pb-3 pt-2">
                        <ResponsiveNavLink
                            :href="route('home')"
                            :active="route().current('home')">
                            Home
                        </ResponsiveNavLink>

                        <ResponsiveNavLink
                            :href="route('events')"
                            :active="route().current('events')">
                            Events
                        </ResponsiveNavLink>

                        <ResponsiveNavLink
                            :href="route('calendar')"
                            :active="route().current('calendar')">
                            Calendar
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="border-t border-gray-200 pb-1 pt-4 dark:border-gray-600">
                        <div class="px-4">
                            <div class="text-base font-medium text-gray-800 dark:text-gray-200">
                                {{ $page.props.auth.user.name }}
                            </div>

                            <div class="text-sm font-medium text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')">
                                Profile
                            </ResponsiveNavLink>

                            <ResponsiveNavLink :href="route('settings')">
                                Settings
                            </ResponsiveNavLink>

                            <ResponsiveNavLink
                                :href="route('logout')"
                                method="post"
                                as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main
                class="lg:px-8bg-red-200 mx-auto flex max-w-7xl flex-col gap-4 py-12 sm:flex-row sm:px-6">
                <!-- menu -->
                <div
                    class="sticky top-4 hidden h-fit w-full flex-col gap-6 overflow-hidden bg-white p-4 text-gray-900 shadow dark:bg-gray-800 dark:text-gray-100 sm:flex sm:w-[25%] sm:rounded-lg sm:p-8">
                    <div class="flex w-full flex-col gap-2">
                        <SidebarMenuButton
                            :active="route().current('home')"
                            to="home"
                            label="Home">
                            <Icon icon="bi:house-fill" />
                        </SidebarMenuButton>

                        <SidebarMenuButton
                            :active="route().current('events')"
                            to="events"
                            label="Events">
                            <Icon icon="bi:bell-fill" />
                        </SidebarMenuButton>

                        <SidebarMenuButton
                            :active="route().current('calendar')"
                            to="calendar"
                            label="Calendar">
                            <Icon icon="bi:calendar-fill" />
                        </SidebarMenuButton>

                        <SidebarMenuButton
                            :active="route().current('profile.edit')"
                            to="profile"
                            label="Profile">
                            <Icon icon="bi:person-fill" />
                        </SidebarMenuButton>

                        <SidebarMenuButton
                            :active="route().current('settings')"
                            to="settings"
                            label="Settings">
                            <Icon icon="bi:gear-fill" />
                        </SidebarMenuButton>
                    </div>

                    <div class="flex w-full flex-col gap-2">
                        <SidebarMenuButton
                            v-if="$page.props.auth.user.is_admin"
                            href
                            :active="route().current('admin')"
                            to="admin"
                            label="Admin">
                            <Icon icon="bi:shield-shaded" />
                        </SidebarMenuButton>

                        <DangerButton
                            :class="{ 'opacity-25': loggingOut }"
                            :disabled="loggingOut"
                            @click="logout">
                            <div class="flex w-full items-center justify-between text-right">
                                <div class="flex items-center gap-3">
                                    <Icon icon="bi:arrow-left-square-fill" />

                                    <span>Log Out</span>
                                </div>

                                <Icon
                                    icon="bi:chevron-right"
                                    class="text-gray-400" />
                            </div>
                        </DangerButton>
                    </div>
                </div>

                <!-- column -->
                <div class="flex w-full flex-col gap-4 sm:w-[75%]">
                    <slot />
                </div>
            </main>
        </div>

        <Toast />
    </div>
</template>
