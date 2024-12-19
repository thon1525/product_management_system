<script setup lang="ts">
import { defineProps, ref } from 'vue';
import { router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';

import { Link } from '@inertiajs/vue3';

// State for controlling the delete confirmation dialog
const showDeleteDialog = ref(false);
const successReq = ref(false);
const customerToDelete = ref<any>(null);
    const successMessage = ref('');
    const errorMessage = ref('');
// Props coming from the Inertia controller
const props = defineProps({
    customers: Array, // List of customers
});

// Method to trigger the delete confirmation dialog
const confirmDelete = (customer: any) => {
    customerToDelete.value = customer; // Store the customer to delete
    showDeleteDialog.value = true;    // Open the confirmation dialog
};

// Method to delete the customer
const deleteCustomer = async () => {
    if (!customerToDelete.value) return; // Ensure there's a customer to delete
    try {
        // Send a DELETE request to the backend
        await router.delete(`/user/management/delete/${customerToDelete.value.id}`, {
            preserveState: true, // Keeps the current page state
            onSuccess: () => {
                successMessage.value = 'Customer deleted successfully!';
                setTimeout(() => errorMessage.value = '', 3000);
            },
            onError: (error) => {
                console.error(error);
                errorMessage.value = 'Failed to delete customer.';
                setTimeout(() => errorMessage.value = '', 3000);
            },
        });
    } catch (error: unknown) {
        console.error(error);
        errorMessage.value = 'An error occurred while deleting the customer.';
    } finally {
        showDeleteDialog.value = false; // Close the confirmation dialog
    }
    return { successMessage, errorMessage };
};



// Method to cancel the delete action
const cancelDelete = () => {
    showDeleteDialog.value = false; // Close the confirmation dialog
};
</script>


<template>
    <Head title="Manage Customers" />

    <AuthenticatedLayout>
        <div class="p-4">
            <h1 class="text-2xl font-bold mb-4">Admin List</h1>
          <!-- Success Message -->
          <div class="flex justify-center ">
        <!-- Success Message -->
        <Message
            v-if="successMessage"
            severity="success"
            class="p-4 mb-4 w-[400px] h-[60px] flex justify-center rounded-lg bg-green-500 text-white border border-green-600 shadow-md"
        >
            {{ successMessage }}
        </Message>
        <Message
                v-if="errorMessage"
                severity="error"
                class="p-4 mb-4 w-[400px] h-[60px] flex justify-center rounded-lg bg-red-500 text-white border border-red-600 shadow-md"
            >
                {{ errorMessage }}
        </Message>

    </div>
        <!-- Error Message -->

            <!-- PrimeVue DataTable -->
            <DataTable :value="customers" responsiveLayout="scroll">
                <Column field="id" header="ID"></Column>
                <Column field="name" header="Name"></Column>
                <Column field="email" header="Email"></Column>
                <Column field="role" header="Role"></Column>
                <Column field="created_at" header="Created At"></Column>
                <Column header="Actions">
                    <template #body="{ data }">
                        <Link :href="route('user.dashboard.management.create.edit', { id: data.id })">
                            <Button
                                icon="pi pi-user-edit"
                                severity="success"
                                aria-label="Edit"
                                class="mr-2"
                            />
                        </Link>
                        <Button
                            icon="pi pi-delete-left"
                            severity="danger"
                            aria-label="Cancel"
                            field="id"
                               @click="confirmDelete(data)"
                        />
                    </template>
                </Column>
            </DataTable>
                <!-- PrimeVue Dialog for Delete Confirmation -->
    <Dialog
            v-model:visible="showDeleteDialog"
            header="Confirm Deletion"
            footer=""
            :style="{ width: '450px' }"
            class="rounded-lg shadow-lg bg-white"
        >
        <div class="mt-4 px-6">
        <p class="mt-2 text-gray-700">Are you sure you want to delete this customer?</p>
        <div class="p-d-flex px-6 p-jc-between mt-4">
            <Button
                label="Cancel"
                icon="pi pi-times"
                class="p-button-text text-gray-500 hover:bg-gray-200"
                @click="cancelDelete"
            />
            <Button
                label="Delete"
                icon="pi pi-check"
                severity="danger"
                class="p-button-danger bg-red-600 hover:bg-red-700 text-white"
                @click="deleteCustomer"
            />
        </div>
        </div>
    </Dialog>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.p-4 {
    padding: 1rem;
}
</style>
