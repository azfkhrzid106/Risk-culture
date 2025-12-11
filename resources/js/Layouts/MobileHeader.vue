<!-- resources/js/Components/Layout/MobileHeader.vue -->
<template>
  <header class="lg:hidden bg-white shadow-sm px-4 py-3 sticky top-0 z-40">
    <div class="flex items-center justify-between">
      <!-- Sidebar Toggle -->
      <button
        @click="$emit('toggleSidebar')"
        class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors"
      >
        <svg
          class="w-6 h-6"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16"
          />
        </svg>
      </button>

      <!-- Title -->
      <h1 class="font-semibold text-gray-900 text-lg truncate">
        {{ title }}
      </h1>

      <!-- Avatar Dropdown -->
      <div class="relative" @click="toggleMenu">
        <img
          src="https://ui-avatars.com/api/?name=Admin&background=3b82f6&color=fff"
          alt="avatar"
          class="w-9 h-9 rounded-full cursor-pointer ring-2 ring-blue-500"
        />

        <!-- Dropdown -->
        <transition
          enter-active-class="transition ease-out duration-200"
          enter-from-class="opacity-0 -translate-y-2"
          enter-to-class="opacity-100 translate-y-0"
          leave-active-class="transition ease-in duration-150"
          leave-from-class="opacity-100 translate-y-0"
          leave-to-class="opacity-0 -translate-y-2"
        >
          <div
            v-if="open"
            class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-xl shadow-lg py-2 z-50"
          >
            <button
              class="w-full px-4 py-2 text-left text-gray-700 hover:bg-gray-100"
            >
              Profil
            </button>
            <button
              class="w-full px-4 py-2 text-left text-red-600 hover:bg-red-50"
            >
              Logout
            </button>
          </div>
        </transition>
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref } from "vue";

defineEmits(["toggleSidebar"]);
defineProps({
  title: {
    type: String,
    default: "K3-INALUM Admin",
  },
});

const open = ref(false);
const toggleMenu = () => {
  open.value = !open.value;
};
</script>
