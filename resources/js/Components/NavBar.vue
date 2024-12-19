<template>
    <nav class="bg-white shadow-md">
      <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-gray-800">Product List</h1>
        <div v-if="auth.user" class="sm:fixed sm:top-0 sm:right-0 p-6 text-end">
          <Link
            :href="route('dashboard')"
            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
          >
            Dashboard
          </Link>
        </div>

        <div v-else class="sm:fixed sm:top-0 sm:right-0 p-6 text-end">
          <Link
            :href="route('login')"
            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
          >
            Log in
          </Link>
          <Link
            v-if="canRegister"
            :href="route('register')"
            class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
          >
            Register
          </Link>
        </div>
      </div>
    </nav>
  </template>

  <script lang="ts">
  import { defineComponent } from 'vue';
  import { Link } from '@inertiajs/inertia-vue3'; // Import the Link component

  export default defineComponent({
    props: {
      auth: Object,
      canLogin: Boolean,
      canRegister: Boolean,
    },
  });
  </script>

  <style scoped>
  /* Optional custom styling */
  </style>
