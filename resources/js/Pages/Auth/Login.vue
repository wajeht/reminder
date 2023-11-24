<script setup lang="ts">
import Card from '@/Components/Card.vue';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Card>
            <Head title="Log in" />

            <form
                class="flex flex-col gap-6"
                @submit.prevent="submit">
                <h2
                    class="text-center text-2xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Login
                </h2>

                <div>
                    <div
                        v-if="status"
                        class="mb-4 text-sm font-medium text-green-600">
                        {{ status }}
                    </div>

                    <div>
                        <InputLabel
                            for="email"
                            value="Email" />

                        <TextInput
                            id="email"
                            v-model="form.email"
                            type="email"
                            class="mt-1 block w-full"
                            required
                            autofocus
                            autocomplete="username" />

                        <InputError
                            class="mt-2"
                            :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel
                            for="password"
                            value="Password" />

                        <TextInput
                            id="password"
                            v-model="form.password"
                            type="password"
                            class="mt-1 block w-full"
                            required
                            autocomplete="current-password" />

                        <InputError
                            class="mt-2"
                            :message="form.errors.password" />
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                        <label class="flex items-center">
                            <Checkbox
                                v-model:checked="form.remember"
                                name="remember" />

                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400"
                                >Remember me</span
                            >
                        </label>

                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800">
                            Forgot your password?
                        </Link>
                    </div>

                    <PrimaryButton
                        class="mt-6 w-full align-middle"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing">
                        <span class="w-full">Log in</span>
                    </PrimaryButton>

                    <div class="mt-6 flex justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400"
                            >Don't have an account yet?</span
                        >

                        <Link
                            :href="route('register')"
                            class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800">
                            Register
                        </Link>
                    </div>
                </div>
            </form>
        </Card>
    </GuestLayout>
</template>
