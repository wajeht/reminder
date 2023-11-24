<script setup lang="ts">
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    agree: false,
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form
            class="flex flex-col gap-6"
            @submit.prevent="submit">
            <h2
                class="text-center text-2xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Register
            </h2>

            <div>
                <div>
                    <InputLabel
                        for="name"
                        value="Name" />

                    <TextInput
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="name" />

                    <InputError
                        class="mt-2"
                        :message="form.errors.name" />
                </div>

                <div class="mt-4">
                    <InputLabel
                        for="email"
                        value="Email" />

                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1 block w-full"
                        required
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
                        autocomplete="new-password" />

                    <InputError
                        class="mt-2"
                        :message="form.errors.password" />
                </div>

                <div class="mt-4">
                    <InputLabel
                        for="password_confirmation"
                        value="Confirm Password" />

                    <TextInput
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="new-password" />

                    <InputError
                        class="mt-2"
                        :message="form.errors.password_confirmation" />
                </div>

                <div class="mt-4 flex flex-col gap-2">
                    <label class="flex items-center gap-4">
                        <div class="flex items-center">
                            <Checkbox
                                v-model:checked="form.agree"
                                name="remember" />

                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400"
                                >I agree</span
                            >
                        </div>

                        <InputError
                            class="mt-[3px] [&_p]:text-xs"
                            :message="form.errors.agree" />
                    </label>

                    <span class="text-sm text-gray-600 dark:text-gray-400"
                        >Signing up signifies that you have read and agree to the
                        <Link
                            :href="route('app.terms')"
                            class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800">
                            Terms of Service</Link
                        >
                        and our
                        <Link
                            :href="route('app.privacy')"
                            class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800">
                            Privacy Policy </Link
                        >.</span
                    >
                </div>

                <PrimaryButton
                    class="mt-6 w-full"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    <span class="w-full"> Register </span>
                </PrimaryButton>

                <div class="mt-6 flex justify-between">
                    <span class="text-sm text-gray-600 dark:text-gray-400"
                        >Already registered?</span
                    >

                    <Link
                        :href="route('login')"
                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800">
                        Login
                    </Link>
                </div>
            </div>
        </form>
    </GuestLayout>
</template>
