<script setup lang="ts">

import CardAuth from '@/Components/CardAuth.vue';

import { Link, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

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
  mustVerifyEmail?: Boolean;
  status?: String;
  ProductModel: Product[];
}>();

const user = usePage().props.auth.user;

const form = useForm({
  name: user.name,
  email: user.email,
  profiles: user.profiles,
});

const profileImage = () => {
  return user.profiles && user.profiles !== ''
    ? `/storage/${user.profiles}` // User-uploaded profile image
    : '/storage/profile.png'; // Default fallback image
};

const showDropdown = ref(false);
const toggleDropdown = () => {
  showDropdown.value = !showDropdown.value;
};
</script>

<template>
  <Head title="Welcome" />
  <div class="min-h-screen bg-gray-100">
    <nav class="bg-white shadow-md">
      <div class="container mx-auto px-4 py-2 flex justify-between items-center">
        <h1 class="text-xl font-bold text-gray-800">Account</h1>

        <!-- Conditional navigation for logged-in users -->
        <div class="relative sm:fixed sm:top-0 sm:right-0 p-6 text-end">
          <div class="flex items-center cursor-pointer" @click="toggleDropdown">
            <Avatar :image="profileImage()" shape="circle" size="normal" />
            <span class="font-semibold ml-2">{{ user.name }}</span>
          </div>

          <!-- Dropdown Menu -->
          <div
            v-if="showDropdown"
            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50"
          >
            <ul class="py-2">
              <li>
                <Link
                  href="/edit-profile"
                  class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                >
             History order
                </Link>
              </li>
              <li>
                <Link
                  href="/logout"
                  class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                >
                  Logout
                </Link>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
      <h2 class="text-2xl font-bold text-gray-800 mb-6">Available Products</h2>

      <!-- Products Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
        <CardAuth
          v-for="product in ProductModel"
          :key="product.id"
          :product="product"
          class="bg-white p-4 shadow rounded-lg"
        />
      </div>
    </main>
  </div>
</template>

<style scoped>
.relative {
  position: relative;
}
</style>
