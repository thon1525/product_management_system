<script setup lang="ts">
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import Aside from '@/Components/partials/Aside.vue';
import Header from '@/Components/partials/Header.vue';



// Sidebar state using ref
const isSidebarOpen = ref(true);

// Toggle sidebar method
const toggleSidebar = () => {
  isSidebarOpen.value = !isSidebarOpen.value;
};
const showingNavigationDropdown = ref(false);



</script>

<template>
  <div class="flex h-screen">
      <!-- Sidebar -->
      <Aside :isSidebarOpen="isSidebarOpen" />


      <!-- Main Content -->
      <div class="flex-1 flex flex-col bg-gray-100">
        <!-- Header -->
        <Header @toggle-sidebar="toggleSidebar" />
        <!-- Form Section -->
        <div class="flex-1 p-6 ">
            <slot />
        </div>
      </div>
    </div>
</template>
