<template>
    <aside
      :class="[
        'bg-gray-800 text-white h-full p-4 flex flex-col space-y-6 transition-all duration-300',
        isSidebarOpen ? 'w-64' : 'w-0 overflow-hidden',
      ]"
    >
      <div v-if="isSidebarOpen" class="text-2xl font-bold">DashStack</div>
      <nav v-if="isSidebarOpen">
        <ul class="space-y-3">
          <li>
            <Button
              label="Dashboard"
              icon="pi pi-home"
              class="p-button-text w-full text-left text-white"
            />
          </li>
          <li>
            <Link    :href="route('create.product')">
                <Button
              label="Products"
              icon="pi pi-box"
              class="p-button-text w-full text-left text-white"
            />
            </Link
            >
          </li>
          <li>
            <Link    :href="route('create.management')">
                <Button
              label="Manage Products"
              icon="pi pi-box"
              class="p-button-text w-full text-left text-white"
            />
            </Link
            >
          </li>
          <li>
            <Button
              label="Calendar"
              icon="pi pi-calendar"
              class="p-button-text w-full text-left text-white"
            />
          </li>
          <li>
            <Link    :href="route('user.dashboard.management.create')">
            <Button
            label="Add User"
            icon="pi pi-user"
            class="p-button-text w-full text-left text-white"
            />
            </Link
            >
          </li>
          <li>
            <Link    :href="route('user.dashboard.management.create')">
            <Button
            label="Add User"
            icon="pi pi-user"
            class="p-button-text w-full text-left text-white"
            />
            </Link
            >
          </li>
          <li>
            <Link    :href="route('user.dashboard.management')">
            <Button
            label="Manage User"
            icon="pi pi-user"
            class="p-button-text w-full text-left text-white"
            />
            </Link
            >
          </li>
        </ul>
      </nav>
    </aside>
  </template>

  <script>
import { Head, Link } from '@inertiajs/vue3';

  export default {
    name: "Aside",
    components: {Link},
    props: {
      isSidebarOpen: {
        type: Boolean,
        required: true,
      },
    },
  };
  </script>
