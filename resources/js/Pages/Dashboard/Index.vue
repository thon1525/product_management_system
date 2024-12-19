<template>
    <div class="flex h-screen">
      <!-- Sidebar -->
      <Aside :isSidebarOpen="isSidebarOpen" />

      <!-- Main Content -->
      <div class="flex-1 flex flex-col bg-gray-100">
        <!-- Header -->
        <Header @toggle-sidebar="toggleSidebar" />

        <!-- Form Section -->
        <div class="flex-1 p-6">
          <Section />
        </div>
      </div>
    </div>
  </template>

  <script>
 import Aside from '@/Components/partials/Aside.vue';
  import Header from '@/Components/partials/Header.vue';
  import Section from '@/Components/partials/Section.vue';

  export default {
    name: "Dashboard",
    components: { Aside, Header, Section },
    data() {
      return {
        isSidebarOpen: true, // Sidebar state
      };
    },
    methods: {
      toggleSidebar() {
        this.isSidebarOpen = !this.isSidebarOpen;
      },
    },
  };
  </script>
