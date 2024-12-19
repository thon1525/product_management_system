<script lang="ts">
import { defineComponent } from 'vue';
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

export default defineComponent({
  components: { ProductCard },
  props: {
    ProductModel: {
      type: Array as () => Product[], // Define as an array of products
      required: true,
    },
    canLogin: {
      type: Boolean,
      default: true,
    },
    canRegister: {
      type: Boolean,
      default: true,
    },
    auth: {
      type: Object,
      default: () => ({
        user: null,
      }),
    },
  },
});
</script>

<template>
  <div class="min-h-screen bg-gray-100">
    <nav class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <h1 class="text-xl font-bold text-gray-800">Product List</h1>

      <!-- Conditional navigation for logged-in users -->
      <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-end">
        <template v-if="$page.props.auth.user">
          <!-- Dashboard link if user is logged in -->
          <Link
            :href="route('dashboard')"
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
        />
      </div>
      <p v-else class="text-gray-600">No products available.</p>
    </main>
  </div>
</template>


