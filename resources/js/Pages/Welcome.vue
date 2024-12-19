<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import ProductCard from '@/Components/ProductCard.vue';

interface Product {
  id: number;
  product_name: string;
  product_price: number;
  product_qty: number;
  product_img: string;
  product_code: string;
  product_description: string;
}

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    ProductModel:  Product[],
}>();
</script>

<template>
    <Head title="Welcome" />
    <div class="min-h-screen bg-gray-100">
      <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
          <h1 class="text-xl font-bold text-gray-800">Product List</h1>

          <!-- Conditional navigation for logged-in users -->
          <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-end">
            <template v-if="$page.props.auth.user">
              <!-- Dashboard link if user is logged in -->
              <Link
                :href="route('constomer.account')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
              >
                Dashboard
              </Link>
            </template>

            <template v-else>
              <!-- Login link if user is not logged in -->
              <Link
                :href="route('login')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
              >
                Log in
              </Link>

              <!-- Register link if user is not logged in and can register -->
              <Link
                v-if="canRegister"
                :href="route('register')"
                class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
              >
                Register
              </Link>
            </template>
          </div>
        </div>
      </nav>
      <main class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Available Products</h2>
        <div v-if="ProductModel.length" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          <ProductCard
            v-for="product in ProductModel"
            :key="product.id"
            :product="product"
            :isAuthenticated="$page.props.auth.user !== null"
          />
        </div>
        <p v-else class="text-gray-600">No products available.</p>
      </main>
    </div>
  </template>


<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
