<script setup lang="ts">
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AdminLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { PageProps } from '@/types';
import { useRouter } from 'vue-router';
// Define the type for page props to handle flash messages

// Use the form with initial values
const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: '', // Add role field
});
// Access the Inertia page props and safely extract flash messages
const page = usePage<PageProps>();
const errorMessage = page.props.flash?.error ?? '';
let  Message = '';
// Handle form submission
const submit = () => {
    form.post(route('user.dashboard.management.store'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation', 'role');
        },
        onSuccess: ()=>{
            const { props } = usePage(); // Access the props sent from Laravel
            const successMessage = page.props.flash?.success ?? '';
            Message = successMessage
        }
    });

};

// Role options for the dropdown
const roles = [
    { label: 'Admin', value: 'admin' },
    { label: 'Customer', value: 'customer' },
];
</script>

<template>
    <Head title="Add Customers" />

    <AuthenticatedLayout>
        <div class="p-4 shadow-md border-2 rounded-md">
            <h1 class="text-xl font-bold mb-4">Add Customer</h1>

                        <div
                v-if="Message"
                class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4 flex justify-between items-center"
            >
                <span>{{ Message }}</span>

                <Link :href="route('user.dashboard.management')">
                    <Button
                        label="Manage User"
                        icon="pi pi-users"
                        class="p-button-success"
                    ></Button>
                </Link>
            </div>


            <!-- Error Message -->
            <div
                v-if="errorMessage"
                class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4"
            >
                {{ errorMessage }}
            </div>

            <div class="flex justify-center">
                <form @submit.prevent="submit" class="w-[50%]">
                    <!-- Name Input -->
                    <div>
                        <InputLabel for="name" value="Name" />
                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <!-- Email Input -->
                    <div class="mt-4">
                        <InputLabel for="email" value="Email" />
                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            required
                            autocomplete="username"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <!-- Password Input -->
                    <div class="mt-4">
                        <InputLabel for="password" value="Password" />
                        <TextInput
                            id="password"
                            type="password"
                            class="mt-1 block w-full"
                            v-model="form.password"
                            required
                            autocomplete="new-password"
                        />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <!-- Password Confirmation -->
                    <div class="mt-4">
                        <InputLabel for="password_confirmation" value="Confirm Password" />
                        <TextInput
                            id="password_confirmation"
                            type="password"
                            class="mt-1 block w-full"
                            v-model="form.password_confirmation"
                            required
                            autocomplete="new-password"
                        />
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>

                    <!-- Role Selection -->
                    <div class="mt-4">
                        <InputLabel for="role" value="Role" />
                        <select
                            id="role"
                            v-model="form.role"
                            class="mt-1 block w-full border rounded-md p-2"
                            required
                        >
                            <option disabled value="">Select a role</option>
                            <option v-for="role in roles" :key="role.value" :value="role.value">
                                {{ role.label }}
                            </option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.role" />
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton
                            class="ms-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Register
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
