<script setup lang="ts">
import NavLink from '@/Components/NavLink.vue';
</script>
<template>
    <div class="flex gap-4 p-4">
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

        <NavLink
            :href="route('login')"
            :active="route().current('login')">
            Login
        </NavLink>
    </div>
</template>
