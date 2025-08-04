<template>
  <div class="min-h-screen flex flex-col justify-between font-sans bg-gray-50 text-gray-800">
    <!-- Navbar -->
    <header class="sticky top-0 z-50 backdrop-blur-md bg-blue-600/80 text-white shadow-md transition-shadow">
      <nav class="container mx-auto px-3 py-2 flex items-center justify-between gap-2">
        <!-- Logo kiri -->
        <div class="leading-tight text-xs flex-shrink-0">
          <div class="font-bold text-sm">INFO<span class="text-yellow-300">K3</span></div>
          <div class="text-[9px] whitespace-nowrap">PT INDONESIA ASAHAN ALUMINIUM</div>
        </div>

        <!-- Menu Desktop -->
        <div class="hidden lg:flex space-x-2 text-xs items-center flex-grow justify-center">
          <Link v-for="item in menu" :key="item.label" :href="item.href"
            :class="[$page.url.startsWith(item.href) ? 'text-yellow-300 font-semibold' : 'hover:text-yellow-300', 'transition px-2 py-1 whitespace-nowrap']">
            {{ item.label }}
          </Link>

          <!-- Dropdown -->
          <div class="relative group">
            <span class="hover:text-yellow-300 cursor-pointer transition px-2 py-1 whitespace-nowrap">Safety Obs ▾</span>
            <div class="absolute z-10 hidden group-hover:flex flex-col bg-white text-black rounded shadow mt-2 w-36 py-1 right-0">
              <Link href="/observation/form" class="px-3 py-1.5 text-xs hover:bg-gray-100">Form</Link>
              <Link href="/observation/report" class="px-3 py-1.5 text-xs hover:bg-gray-100">Report</Link>
            </div>
          </div>
        </div>

        <!-- Date Time & Login -->
        <div class="flex items-center gap-2 flex-shrink-0">
          <!-- Date Time -->
          <div class="hidden md:block text-xs font-medium whitespace-nowrap">
            {{ currentDateTime }}
          </div>
          <Link href="/login"
            class="hidden md:inline-block bg-white text-blue-600 px-3 py-1 text-xs rounded hover:bg-gray-100 transition whitespace-nowrap">
            Login
          </Link>

          <button @click.stop="toggleMobileMenu" class="lg:hidden focus:outline-none">
            <svg class="w-5 h-5" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round"
                :d="isMobileMenuOpen ? 'M6 18L18 6M6 6l12 12' : 'M4 6h16M4 12h16M4 18h16'" />
            </svg>
          </button>
        </div>
      </nav>

      <!-- Mobile Menu -->
      <transition name="slide-fade">
        <div v-if="isMobileMenuOpen"
          class="fixed inset-0 h-screen bg-white text-black z-40 p-6 pt-20 space-y-3 lg:hidden overflow-y-auto">
          <button @click="toggleMobileMenu" class="absolute top-4 right-4 text-gray-600 hover:text-black text-xl">✕</button>
          <div class="text-sm space-y-3 mt-8">
            <Link v-for="item in menu" :key="item.label" :href="item.href" class="block" @click="closeMenu">
              {{ item.label }}
            </Link>

            <div class="space-y-2 pt-4 border-t border-gray-200">
              <div class="font-semibold text-gray-700">Safety Observation</div>
              <Link href="/observation/form" class="block pl-2 text-sm text-blue-700 hover:underline" @click="closeMenu">Form Observation</Link>
              <Link href="/observation/report" class="block pl-2 text-sm text-blue-700 hover:underline" @click="closeMenu">Report Observation</Link>
            </div>

            <div class="pt-6">
              <Link href="/login"
                class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 text-sm transition block text-center">
                Login
              </Link>
            </div>
          </div>
        </div>
      </transition>

      <!-- Breaking News -->
      <div class="bg-yellow-100 text-black py-1 px-4 text-xs border-t border-gray-300 flex items-center gap-2">
        <svg class="w-3 h-3 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M11 11V5a1 1 0 011-1h1.586a1 1 0 01.707.293l5.414 5.414A1 1 0 0120 10.414V19a1 1 0 01-1 1h-8a1 1 0 01-1-1v-1" />
        </svg>
        <span class="truncate"><strong>BREAKING:</strong> Safety Awareness Week dimulai Oktober 2023!</span>
      </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-20 text-center">
      <h1
        class="text-4xl sm:text-5xl font-extrabold text-blue-700 mb-4 motion-safe:animate-fade-in tracking-tight leading-snug">
        Selamat Datang di <span class="text-red-500">K3-inalum</span>
      </h1>
      <p class="text-lg text-gray-600 mb-6 motion-safe:animate-slide-up delay-100">
        Sistem Informasi Keselamatan dan Kesehatan Kerja untuk mendukung <strong>Inalum Safety Culture</strong>
      </p>
      <div class="flex flex-col sm:flex-row justify-center gap-4 motion-safe:animate-fade-in delay-300">
        <Link href="/pelajari"
          class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow transition">
          Pelajari Lebih Lanjut
        </Link>
        <Link href="/video"
          class="bg-white border border-blue-600 text-blue-600 px-6 py-2 rounded-lg hover:bg-blue-50 transition">
          Video Edukasi
        </Link>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-teal-800 text-white text-center py-4 text-sm">
      © 2025 K3-inalum — Semua Hak Dilindungi
    </footer>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const isMobileMenuOpen = ref(false);
const toggleMobileMenu = () => isMobileMenuOpen.value = !isMobileMenuOpen.value;
const closeMenu = () => isMobileMenuOpen.value = false;

const menu = [
  { label: 'Beranda', href: '/' },
  { label: 'Profil', href: '/profil' },
  { label: 'Download', href: '/download' },
  { label: 'Galeri Foto', href: '/galeri' },
  { label: 'Kuis K3', href: '/kuis' },
  { label: 'Kontak SSM Safety', href: '/kontak' },
  { label: 'Survei', href: '/survey' },
];

const currentDateTime = ref('');
let dateTimeInterval = null;

const updateDateTime = () => {
  try {
    const now = new Date();
    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
    
    // Format yang lebih ringkas untuk header
    const day = days[now.getDay()];
    const date = now.getDate();
    const month = months[now.getMonth()];
    const year = now.getFullYear();
    
    // Format waktu manual untuk memastikan konsistensi
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    
    currentDateTime.value = `${day}, ${date} ${month} ${year}, ${hours}:${minutes}:${seconds} WIB`;
  } catch (error) {
    console.error('Error updating date time:', error);
    currentDateTime.value = 'Error loading time';
  }
};

onMounted(() => {
  // Set initial value immediately
  updateDateTime();
  
  // Start interval
  dateTimeInterval = setInterval(updateDateTime, 1000);
});

// Cleanup interval when component unmounts
onUnmounted(() => {
  if (dateTimeInterval) {
    clearInterval(dateTimeInterval);
  }
});
</script>

<style>
.slide-fade-enter-active,
.slide-fade-leave-active {
  transition: all 0.3s ease;
}
.slide-fade-enter-from,
.slide-fade-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}

@keyframes fade-in {
  from { opacity: 0; }
  to { opacity: 1; }
}
.animate-fade-in {
  animation: fade-in 1s ease-in-out;
}

@keyframes slide-up {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
.animate-slide-up {
  animation: slide-up 0.8s ease-out;
}
</style>