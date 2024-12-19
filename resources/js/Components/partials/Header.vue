<template>
    <header class="flex justify-between items-center p-4 bg-white shadow-md">
      <!-- Sidebar Toggle Button -->
      <Button
        @click="$emit('toggle-sidebar')"
        class="lg:hidden"
        icon="pi pi-bars"
        aria-label="Toggle Sidebar"
      />

      <div>
        <h1 class="text-2xl font-semibold">Dashboard</h1>
      </div>

      <div class="flex items-center space-x-4">
        <i class="pi pi-bell text-xl"></i>
        <div class="flex items-center space-x-2">
          <Avatar
            image="https://via.placeholder.com/32"
            shape="circle"
            size="large"
          />
          <span class="font-semibold">Moni Roy</span>
        </div>
      </div>
    </header>
  </template>

  <script>
  export default {
    name: "Header",
    emits: ["toggle-sidebar"], // Emits an event to toggle the sidebar
  };
  </script>
