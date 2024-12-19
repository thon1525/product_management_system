<script setup lang="ts">
import { ref, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AdminLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { PageProps } from '@/types';

// Access user data from the Inertia page props
const page = usePage<PageProps>();
const user = page.props.user;

// Use the form and prefill with the user's data
const form = useForm({
    name: user.name || '',
    email: user.email || '',
    role: user.role || '', // Add role field
});

// Handle form submission
const submit = () => {
    form.patch(route('user.dashboard.management.update', user.id), {
        onSuccess: () => {
            alert('User updated successfully!');
        },
        onError: (errors) => {
            console.error('Update failed:', errors);
        },
    });
};

// Role options for the dropdown
const roles = [
    { label: 'Admin', value: 'admin' },
    { label: 'Customer', value: 'customer' },
];
</script>

<template>
    <Head title="Edit User" />

    <AuthenticatedLayout>
        <div class="p-4 shadow-md border-2 rounded-md flex justify-center">
            <h1 class="text-xl font-bold mb-4">Edit User</h1>

            <!-- Form -->
            <form @submit.prevent="submit" class="mt-6 space-y-6 w-[50%]">
                <div>
                    <InputLabel for="name" value="Name" />
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div>
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div>
                    <InputLabel for="role" value="Role" />
                    <select
                        id="role"
                        class="mt-1 block w-full"
                        v-model="form.role"
                        required
                    >
                        <option v-for="role in roles" :key="role.value" :value="role.value">
                            {{ role.label }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.role" />
                </div>

                <div class="flex items-center gap-4">
                    <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
