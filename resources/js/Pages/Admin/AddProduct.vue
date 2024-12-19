<script setup lang="ts">
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AdminLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { PageProps } from '@/types';

// Define the type for form data
interface ProductForm {
    product_name: string;
    product_price: string | number;
    product_qty: string | number;
    product_img: File | null;
    product_code: string;
    product_description: string;
}

// Initialize the reactive form data
const form = useForm<ProductForm>({
    product_name: '',
    product_price: '',
    product_qty: '',
    product_img: null,
    product_code: '',
    product_description: ''
});
let  Message = '';
// Reactive state for image preview
const imagePreview = ref<string | null>(null);

// Handle image selection and set preview
const handleImageChange = (event: Event) => {
    const file = (event.target as HTMLInputElement).files?.[0];
    if (file) {
        form.product_img = file;

        // Generate a URL for the preview
        const reader = new FileReader();
        reader.onload = () => {
            imagePreview.value = reader.result as string;
        };
        reader.readAsDataURL(file);
    } else {
        form.product_img = null;
        imagePreview.value = null;
    }
};

// Handle form submission
const submit = () => {
    const formData = new FormData();

    // Append fields to FormData
    formData.append('product_name', form.product_name);
    formData.append('product_price', form.product_price.toString());
    formData.append('product_qty', form.product_qty.toString());
    formData.append('product_code', form.product_code);

    if (form.product_img) {
        formData.append('product_img', form.product_img);
    }
 console.log(form.product_img)
    // Post the form data
    form.post(route('create.product.store'), {
        data: formData,
        onSuccess: () => {
            const { props } = usePage();
            const successMessage = props.flash?.success ?? '';
            Message = successMessage;
        },
    });
};
</script>

<template>
    <Head title="Add Product" />

    <AuthenticatedLayout>
        <div class="p-4 shadow-md border-2 rounded-md">
            <h1 class="text-xl font-bold mb-4">Add Product</h1>
            <div
                    v-if="Message"
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4 flex justify-between items-center"
                >
                    <span>{{ Message }}</span>

                    <Link :href="route('create.management')">
                        <Button
                            label="Manage User"
                            icon="pi pi-users"
                            class="p-button-success"
                        ></Button>
                    </Link>
                </div>
            <div class="flex justify-center">




                <form @submit.prevent="submit" class="w-[50%]">
                    <!-- Product Name -->
                    <div>
                        <InputLabel for="product_name" value="Product Name" />
                        <TextInput
                            id="product_name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.product_name"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.product_name" />
                    </div>

                    <!-- Product Price -->
                    <div class="mt-4">
                        <InputLabel for="product_price" value="Product Price" />
                        <TextInput
                            id="product_price"
                            type="number"
                            class="mt-1 block w-full"
                            v-model="form.product_price"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.product_price" />
                    </div>

                    <!-- Product Quantity -->
                    <div class="mt-4">
                        <InputLabel for="product_qty" value="Product Quantity" />
                        <TextInput
                            id="product_qty"
                            type="number"
                            class="mt-1 block w-full"
                            v-model="form.product_qty"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.product_qty" />
                    </div>

                    <!-- Product Image -->
                    <div class="mt-4">
                        <InputLabel for="product_img" value="Product Image" />
                        <input
                            id="product_img"
                            type="file"
                            class="mt-1 block w-full"
                            @change="handleImageChange"
                        />
                        <InputError class="mt-2" :message="form.errors.product_img" />
                    </div>

                    <!-- Image Preview -->
                    <div v-if="imagePreview" class="mt-4 flex justify-center">
                        <img
                            :src="imagePreview"
                            alt="Image Preview"
                            class="w-[200px] h-[200px] rounded-md shadow-md"
                        />
                    </div>

                    <!-- Product Code -->
                    <div class="mt-4">
                        <InputLabel for="product_code" value="Product Code" />
                        <TextInput
                            id="product_code"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.product_code"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.product_code" />
                    </div>

                    <div>
                        <InputLabel for="product description" value="product description" />
                        <textarea  cols="50"  class="mt-1 block w-full" v-model="form.product_description" id="product_description"></textarea>
                        <InputError class="mt-2" :message="form.errors.product_description" />
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Add Product
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
