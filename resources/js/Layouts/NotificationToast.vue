<!-- resources/js/Components/Layout/MobileHeader.vue -->
<template>
  <header class="lg:hidden bg-white shadow-sm px-4 py-3 sticky top-0 z-40">
    <div class="flex items-center justify-between">
      <button @click="$emit('toggleSidebar')" class="p-2 rounded-lg text-gray-600 hover:bg-gray-100">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
      <h1 class="font-semibold text-gray-900">K3-INALUM Admin</h1>
      <div class="w-8 h-8 bg-blue-500 rounded-full"></div>
    </div>
  </header>
</template>

<script setup>
defineEmits(['toggleSidebar']);
</script>