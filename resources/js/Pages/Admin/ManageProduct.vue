<script setup lang="ts">
import { defineProps, ref } from 'vue';
import { router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import Barcode from '@/Components/Barcode.vue';

// Props from Laravel Controller
const props = defineProps({
    ProductModel: Array, // List of products
});

// Reactive state for dialog and messages
const showDeleteDialog = ref(false);
const successMessage = ref('');
const errorMessage = ref('');
const productToDelete = ref<any>(null);

// Delete confirmation
const confirmDelete = (product: any) => {
    productToDelete.value = product;
    showDeleteDialog.value = true;
};

// Delete product action
const deleteProduct = async () => {
    if (!productToDelete.value) return;

    try {
        await router.delete(`/product/delete/${productToDelete.value.id}`, {
            onSuccess: () => {
                successMessage.value = 'Product deleted successfully!';
                setTimeout(() => (successMessage.value = ''), 3000);
            },
            onError: (error) => {
                console.error(error);
                errorMessage.value = 'Failed to delete the product.';
                setTimeout(() => (errorMessage.value = ''), 3000);
            },
        });
    } catch (error) {
        console.error(error);
        errorMessage.value = 'An error occurred while deleting the product.';
    } finally {
        showDeleteDialog.value = false; // Close dialog
    }
};

// Cancel delete action
const cancelDelete = () => {
    showDeleteDialog.value = false;
};
</script>

<template>
    <Head title="Manage Products" />

    <AuthenticatedLayout>
        <div class="p-4">
            <h1 class="text-2xl font-bold mb-4">Product List</h1>

            <!-- Success/Error Messages -->
            <div v-if="successMessage" class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                {{ successMessage }}
            </div>
            <div v-if="errorMessage" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                {{ errorMessage }}
            </div>

            <!-- DataTable -->
            <DataTable :value="ProductModel" responsiveLayout="scroll" class="shadow-md rounded-lg">
                <Column field="id" header="ID" :style="{ width: '50px' }"></Column>
                <Column header="Image">
                    <template #body="{ data }">
                        <img
                            :src="`/storage/${data.product_img}`"
                            alt="Product Image"
                            class="w-12 h-12 rounded-full object-cover"
                        />
                    </template>
                </Column>
                <Column field="product_name" header="Product Name"></Column>
                <Column field="product_price" header="Price"></Column>
                <Column field="product_qty" header="Quantity"></Column>
                <Column header="Barcode">
                    <template #body="{ data }">
                        <Barcode :value="data.product_code" />
                    </template>
                </Column>
                <Column field="product_description" header="Description"></Column>
                <Column header="Actions">
                    <template #body="{ data }">
                        <!-- <Link :href="route('product.edit', { id: data.id })">
                            <Button icon="pi pi-pencil" class="p-button-rounded p-button-success mr-2" />
                        </Link> -->
                        <Button
                            icon="pi pi-trash"
                            class="p-button-rounded p-button-danger"
                            @click="confirmDelete(data)"
                        />
                    </template>
                </Column>

            </DataTable>

            <!-- Delete Confirmation Dialog -->
            <Dialog v-model:visible="showDeleteDialog" header="Confirm Deletion" :style="{ width: '400px' }">
                <div>
                    <p>Are you sure you want to delete this product?</p>
                    <div class="flex justify-end mt-4">
                        <Button label="Cancel" class="p-button-text mr-2" @click="cancelDelete" />
                        <Button label="Delete" class="p-button-danger" @click="deleteProduct" />
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
